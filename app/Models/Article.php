<?php

namespace App\Models;

use App\Events\ArticleDeleted;
use App\Events\ArticleUpdated;
use App\Events\ArticleCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'owner_id', 'slug', 'description', 'text', 'is_published'];

    protected $dispatchesEvents = [
        'created' => ArticleCreated::class,
        'updated' => ArticleUpdated::class,
        'deleted' => ArticleDeleted::class,
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', 1);
    }

    public static function publishedAndUser()
    {
        $articlesPublished = self::published();
        $articlesNoPublishedUser = self::where([['owner_id', '=', auth()->id()], ['is_published', '=', 0]]);
        $articles = $articlesPublished->unionAll($articlesNoPublishedUser);

        return $articles;
    }

}

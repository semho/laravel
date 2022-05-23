<?php

namespace App\Models;

use App\Events\ArticleDeleted;
use App\Events\ArticleUpdated;
use App\Events\ArticleCreatd;
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

    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id');
    }

    public static function scopePublished($query)
    {
        return $query->where('is_published', 1);
    }

    public static function publishedAndUser()
    {
        $articlesPublished = static::published();
        $articlesNoPublishedUser = static::where([['owner_id', '=', auth()->id()], ['is_published', '=', 0]]);
        $articles = $articlesPublished->unionAll($articlesNoPublishedUser);

        return $articles;
    }

    public static function getArticle($slug)
    {
        return static::where('slug', $slug)->first();
    }
}

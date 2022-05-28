<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiding extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'owner_id', 'slug', 'description', 'text', 'is_published'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public static function getTiding(Tiding $tiding)
    {
        return static::where('slug', $tiding->slug)->first();
    }

    public static function getTidingBySlug($slug)
    {
        return static::where('slug', $slug)->first();
    }

    public static function scopePublished($query)
    {
        return $query->where('is_published', 1);
    }

    public static function publishedAndUser()
    {
        $tidingsPublished = static::published();
        $tidingsNoPublishedUser = static::where([['owner_id', '=', auth()->id()], ['is_published', '=', 0]]);
        $tidings = $tidingsPublished->unionAll($tidingsNoPublishedUser);

        return $tidings;
    }

    public function commentTiding()
    {
        $comments = $this->morphOne(Comment::class, 'commentable')->get()->each(function ($item) {
            $item['author'] = User::find($item->owner_id)->name;
            return $item;
        });

        return $comments;
    }

}

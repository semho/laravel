<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Tiding extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'owner_id', 'slug', 'description', 'text', 'is_published'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function() {
            Cache::tags(['tidings', 'tidingsCount', 'tidings_tags'])->flush();
        });
        static::updated(function() {
            Cache::tags(['tidings', 'tidings_tags'])->flush();
        });
        static::deleted(function() {
            Cache::tags(['tidings', 'tidingsCount', 'tidings_tags'])->flush();
        });
    }

    public static function getTidings()
    {
        if (Auth::check()) {
            $tidings = Cache::tags('tidings')->remember('user_tidings|' . auth()->user()->id, now()->addWeek(), function () {
                if (Role::isAdmin(auth()->user())) {
                    return static::select('*')->orderByDesc('id')->simplePaginate(10);
                } else {
                    return static::publishedAndUser()->orderByDesc('id')->simplePaginate(10);
                }
            });
        } else {
            $tidings = Cache::tags('tidings')->remember('no_auth', now()->addWeek(), function () {
                return static::published()->orderByDesc('id')->simplePaginate(10);
            });
        }

        return $tidings;
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public static function getTiding(Tiding $tiding)
    {
        return Cache::remember('tiding' . $tiding->slug, now()->addWeek(), function() use ($tiding) {
            return static::where('slug', $tiding->slug)->first();
        });
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

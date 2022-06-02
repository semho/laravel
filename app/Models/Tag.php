<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::created(function() {
            Cache::tags(['articles_tags', 'tidings_tags'])->flush();
        });
        static::updated(function() {
            Cache::tags(['articles_tags', 'tidings_tags'])->flush();
        });
        static::deleted(function() {
            Cache::tags(['articles_tags', 'tidings_tags'])->flush();
        });
    }

    public function articles()
    {
        return $this->morphedByMany(Article::class, 'taggable')->published();
    }

    public function tidings()
    {
        return $this->morphedByMany(Tiding::class, 'taggable')->published();
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public static function tagsCloud()
    {
        return (new static)->has('articles')->get();
    }

    public static function tagsCloudTidings()
    {
        return (new static)->has('tidings')->get();
    }
}

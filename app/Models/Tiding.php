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

    public static function getTiding(Tiding $tiding)
    {
        return static::where('slug', $tiding->slug)->first();
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
}

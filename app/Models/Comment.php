<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $fillable = ['commentable_type', 'commentable_id', 'text', 'owner_id'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public static function getComments($article)
    {
        $comments = $article->comments()->get()->each(function ($item) {
            $item['author'] = User::find($item->owner_id)->name;
            return $item;
        });

        return $comments;
    }
}

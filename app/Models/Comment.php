<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $fillable = ['text', 'owner_id', 'article_id'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id');
    }

    public static function getComments($article)
    {
        $comments = $article->comments()->get();

        foreach ($comments as $comment) {
            $comment['author'] = User::find($comment->owner_id)->name;
        }

        return $comments;
    }
}

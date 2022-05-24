<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticle;
use App\Models\Article;
use App\Models\Comment;
use App\Services\TagsSynchronizer;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store($slug)
    {
        $attributes = request()->validate([
            'text' => 'required|max:200',
        ]);
        $attributes['owner_id'] = auth()->id();
        $attributes['article_id'] = Article::getArticle($slug)->id;

        $comment = Comment::create($attributes);

        return redirect('/articles/'. $slug)->with('info', 'Комментарий успешно добавлен');
    }

}

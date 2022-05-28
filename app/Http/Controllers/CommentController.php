<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Tiding;

class CommentController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeArticle($slug)
    {
        $attributes = request()->validate([
            'text' => 'required|max:200',
        ]);
        $attributes['owner_id'] = auth()->id();
        $attributes['commentable_type'] = Article::class;
        $is_article = Article::getArticle($slug);
        if (!$is_article) abort(404);
        $attributes['commentable_id'] = $is_article->id;

        Comment::create($attributes);

        return redirect('/articles/'. $slug)->with('info', 'Комментарий успешно добавлен');
    }

    public function storeTiding($slug)
    {
        $attributes = request()->validate([
            'text' => 'required|max:200',
        ]);
        $attributes['owner_id'] = auth()->id();
        $attributes['commentable_type'] = Tiding::class;
        $is_tiding = Tiding::getTidingBySlug($slug);
        if (!$is_tiding) abort(404);
        $attributes['commentable_id'] = $is_tiding->id;

        Comment::create($attributes);

        return redirect('/tidings/'. $slug)->with('info', 'Комментарий успешно добавлен');
    }

}

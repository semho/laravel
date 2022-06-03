<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticle;
use App\Models\Article;
use App\Services\Pushall;
use App\Services\TagsSynchronizer;
use App\Events\ArticleUpdatedBySocketForAdmin;
use Illuminate\Support\Facades\Cache;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        if (request()->getRequestUri() != '/') {
            Cache::tags(['articles'])->flush();
        }

        $articles = Article::getArticles();

        return view('articles.index', ['articles' => $articles]);
    }

    public function show($slug)
    {
        $article = Article::getArticle($slug);
        if (!$article) abort(404);
        $comments = $article->commentArticle();

        return view('articles.show', compact('article', 'comments'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(StoreArticle $request, TagsSynchronizer $tagsSynchronizer, Pushall $pushall)
    {
        $attributes = $request->validated();
        $attributes['owner_id'] = auth()->id();

        $article = Article::create($attributes);

        $tags = collect(explode(',', request('tags')))->keyBy(function ($item) {
            return $item;
        });

        $tagsSynchronizer->sync($tags, $article);

        $pushall->send('Новая статья: ' . $attributes['name'], 'На сайте создана новая статья');

        return redirect('/')->with('info', 'Статья успешно создана');
    }

    public function edit($slug)
    {
        $article = Article::getArticle($slug);
        if (!$article) abort(404);

        $this->authorize('update', $article);

        return view('articles.edit', compact('article'));
    }

    public function update($slug, StoreArticle $request, TagsSynchronizer $tagsSynchronizer)
    {
        $article = Article::getArticle($slug);
        if (!$article) abort(404);

        $attributes = $request->validated();
        $article->update($attributes);

        $tags = collect(explode(',', request('tags')))->keyBy(function ($item) {
            return $item;
        });

        $tagsSynchronizer->sync($tags, $article);

        event(new ArticleUpdatedBySocketForAdmin($article, auth()->user()));

        Cache::tags('article_' . $slug)->flush();

        return redirect('/')->with('info', 'Статья успешно обновлена');
    }

    public function destroy($slug)
    {
        $article = Article::getArticle($slug);
        if (!$article) abort(404);

        $this->authorize('delete', $article);

        $article->delete();

        return redirect('/')->with('info', 'Статья удалена');
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticle;
use App\Models\Article;
use App\Services\TagsSynchronizer;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $articles = Article::with('tags')->latest()->get();
        return view('articles.index', compact('articles'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->first();
        return view('articles.show', compact('article'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(StoreArticle $request, TagsSynchronizer $tagsSynchronizer)
    {
        $attributes = $request->validated();
        $attributes['owner_id'] = auth()->id();

        $article = Article::create($attributes);

        $tags = collect(explode(',', request('tags')))->keyBy(function ($item) {
            return $item;
        });

        $tagsSynchronizer->sync($tags, $article);

        return redirect('/')->with('info', 'Статья успешно создана');
    }

    public function edit($slug)
    {
        $article = Article::where('slug', $slug)->first();

        $this->authorize('update', $article);

        return view('articles.edit', compact('article'));
    }

    public function update($slug, StoreArticle $request, TagsSynchronizer $tagsSynchronizer)
    {

        $article = Article::where('slug', $slug)->first();
        $attributes = $request->validated();
        $article->update($attributes);

        $tags = collect(explode(',', request('tags')))->keyBy(function ($item) {
            return $item;
        });

        $tagsSynchronizer->sync($tags, $article);

        return redirect('/')->with('info', 'Статья успешно обновлена');
    }

    public function destroy($slug)
    {
        $article = Article::where('slug', $slug)->first();

        $this->authorize('delete', $article);

        $article->delete();

        return redirect('/')->with('info', 'Статья удалена');
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticle;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->get();
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

    public function store(StoreArticle $request)
    {
        $request->validated();

        $article = new Article();
        $article->name = request('name');
        $article->slug = request('slug');
        $article->description = request('desc');
        $article->text = request('text');
        $article->is_published = 1;
        if (request('published') != 'on') {
            $article->is_published = 0;
        }
        $article->save();

        return redirect('/')->with('info', 'Статья успешно создана');
    }

    public function edit($slug)
    {
        $article = Article::where('slug', $slug)->first();
        return view('articles.edit', compact('article'));
    }

    public function update($slug, StoreArticle $request)
    {
        $article = Article::where('slug', $slug)->first();
        $request->validated();

        $article->name = request('name');
        $article->slug = request('slug');
        $article->description = request('desc');
        $article->text = request('text');
        $article->is_published = 1;
        if (request('published') != 'on') {
            $article->is_published = 0;
        }
        $article->save();

        return redirect('/')->with('info', 'Статья успешно обновлена');
    }

    public function destroy($slug)
    {
        $article = Article::where('slug', $slug)->first();
        $article->delete();
        return redirect('/')->with('info', 'Статья удалена');
    }

}

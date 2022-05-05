<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Str;

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

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|between:5,100',
            'slug' => 'required|unique:App\Models\Article,slug|regex:/^[^-_0-9a-z]$/i',
            'desc' => 'required|max:255',
            'text' => 'required',
        ]);

        $article = new Article();
        $article->name = request('name');
        $article->slug = request('slug');
        $article->description = request('desc');
        $article->text = request('text');
        if (request('published') != 'on') {
            $article->is_published = 0;
        }

        $article->save();

        return redirect('/');
    }
}

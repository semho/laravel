<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticle;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Tag;

class ArticlesController extends Controller
{
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

    public function store(StoreArticle $request)
    {
        $attributes = $request->validated();

        Article::create($attributes);

        $tags = collect(explode(',', request('tags')))->keyBy(function ($item) {
            return $item;
        });
        
        $this->sync($tags, $article);

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
        $attributes = $request->validated();
        $article->update($attributes);

        $tags = collect(explode(',', request('tags')))->keyBy(function ($item) {
            return $item;
        });

        $this->sync($tags, $article);

        return redirect('/')->with('info', 'Статья успешно обновлена');
    }

    public function destroy($slug)
    {
        $article = Article::where('slug', $slug)->first();
        $article->delete();
        return redirect('/')->with('info', 'Статья удалена');
    }


    /**
     * @var $tags - коллекция тегов отправленная из формы
     * @var $model - модель к которой нужно привязать теги
     */
    public function sync(Collection $tags, Article $model)
    {

        if (!$model->tags->isEmpty()) {
            /** коллекция теги были привязанные к статье: */
            $articleTags = $model->tags->keyBy('name');
            /** массив с прежними id тегами, которые остались привязанные к статье */
            $syncIds = $articleTags->intersectByKeys($tags)->pluck('id')->toArray();
            /** коллекция ТОЛЬКО новых введенных тегов в форму */
            $tags = $tags->diffKeys($articleTags);
        }

        /** каждый новый тег сравнимаем с БД, если нет создаем, затем id помещаем в массив с уже привязаными тегами */
        foreach ($tags as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $syncIds[] = $tag->id;
        }

        $model->tags()->sync($syncIds);

    }

}

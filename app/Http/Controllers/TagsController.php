<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Support\Facades\Cache;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        if (preg_match('/(\?page=)/', request()->getRequestUri())) {
            Cache::tags(['articles_tags'])->flush();
        }

        $articles = Cache::tags('articles_tags')->remember('articles_tags_' . $tag->name, now()->addWeek(), function () use ($tag){
            return $tag->articles()->with('tags')->orderByDesc('id')->simplePaginate(10);
        });

        return view('articles.index', compact('articles'));
    }

    public function tidings(Tag $tag)
    {
        if (preg_match('/(\?page=)/', request()->getRequestUri())) {
            Cache::tags(['tidings_tags'])->flush();
        }

        $tidings = Cache::tags('tidings_tags')->remember('tidings_tags_' . $tag->name, now()->addWeek(), function () use ($tag) {
            return $tag->tidings()->with('tags')->orderByDesc('id')->simplePaginate(10);
        });

        return view('tidings.index', compact('tidings'));
    }
}

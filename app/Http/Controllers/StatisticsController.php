<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tiding;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index()
    {
        //количество статей всего
        $countArticles = Article::count();

        //количество новостей всего
        $countTidings = Tiding::count();

        //максимальное созданное количесво статей одним пользователем
        $userWithMaxValueArticles = DB::table('articles')
            ->join('users', 'users.id', '=', 'articles.owner_id')
            ->select('owner_id', 'users.name', DB::raw('count(*) as total'))
            ->groupBy('owner_id', 'users.name')
            ->orderBy('total', 'desc')
            ->first();

        //максимальная и минимальная длинна строки названия статьи
        $articlesSortByLengthName = DB::table('articles')
            ->select('name', 'slug', DB::raw('max(length(name)) as max'))
            ->groupBy('name', 'slug')
            ->orderBy('max', 'desc')->get();
        $articleWithMaxLongName = $articlesSortByLengthName->first();
        $articleWithMinLongName = $articlesSortByLengthName->last();

        //среднее количество статей у активных пользователей
        $activeUsers = DB::table('articles')
            ->join('users', 'users.id', '=', 'articles.owner_id')
            ->select('owner_id', 'users.name', DB::raw('count(*) as total'))
            ->groupBy('owner_id', 'users.name')
            ->having('total', '>', 1);

        $avgCountArticles = (int)round($activeUsers->avg('total'));

        //выбираем статьи, которые хоть раз обновлялись и забираем статьию у которой больше всех обновлений
        $mostUpdateArticle = DB::table('articles')
            ->join('article_histories', 'article_histories.article_id', '=', 'articles.id')
            ->select('articles.name', 'articles.slug', DB::raw('count(articles.name) as max'))
            ->groupBy('articles.name', 'articles.slug')
            ->orderBy('max', 'desc')->first();

        //самая обсуждаемая статья
        $mostDiscussedArticle = DB::table('articles')
            ->join('comments', 'comments.commentable_id', '=', 'articles.id')
            ->select('articles.name', 'articles.slug', 'comments.commentable_type', DB::raw('count(comments.commentable_id) as max'))
            ->groupBy('articles.name', 'articles.slug', 'comments.commentable_type')
            ->having('comments.commentable_type', 'App\Models\Article')
            ->orderBy('max', 'desc')->first();

        return view('layout.statistics', [
            'countArticles' => $countArticles,
            'countTidings' => $countTidings,
            'userWithMaxValueArticles' => $userWithMaxValueArticles,
            'articleWithMaxLongName' => $articleWithMaxLongName,
            'articleWithMinLongName' => $articleWithMinLongName,
            'avgCountArticles' => $avgCountArticles,
            'mostUpdateArticle' => $mostUpdateArticle,
            'mostDiscussedArticle' => $mostDiscussedArticle
        ]);
    }

}

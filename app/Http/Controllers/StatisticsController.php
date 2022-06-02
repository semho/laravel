<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tiding;
use Illuminate\Support\Facades\Cache;

class StatisticsController extends Controller
{
    public function index()
    {
        //количество статей всего
        $countArticles = Cache::tags('articlesCount')->remember('articlesCount', now()->addWeek(), function () {
            return Article::count();
        });

        //количество новостей всего
        $countTidings = Cache::tags('tidingsCount')->remember('tidingsCount', now()->addWeek(), function () {
            return Tiding::count();
        });

        //максимальное созданное количесво статей одним пользователем
        $userWithMaxValueArticles = Cache::tags('getMaxCountArticlesUser')->remember('getMaxCountArticlesUser', now()->addWeek(), function () {
            return Article::getMaxCountArticlesUser();
        });

        //максимальная и минимальная длинна строки названия статьи
        $articleWithMaxLongName = Cache::tags('getArticleMaxLengthName')->remember('getArticleMaxLengthName', now()->addWeek(), function () {
            return Article::getArticleMaxLengthName();
        });
        $articleWithMinLongName = Cache::tags('getArticleMinLengthName')->remember('getArticleMinLengthName', now()->addWeek(), function () {
            return Article::getArticleMinLengthName();
        });

        //среднее количество статей у активных пользователей
        $avgCountArticles = Cache::tags('getAvgCountArticles')->remember('getAvgCountArticles', now()->addWeek(), function () {
            return Article::getAvgCountArticles();
        });

        //выбираем статьи, которые хоть раз обновлялись и забираем статьию у которой больше всех обновлений
        $mostUpdateArticle = Cache::tags('getMostUpdatedArticle')->remember('getMostUpdatedArticle', now()->addWeek(), function () {
            return Article::getMostUpdatedArticle();
        });

        //самая обсуждаемая статья
        $mostDiscussedArticle = Cache::tags('getMostDiscussedArticle')->remember('getMostDiscussedArticle', now()->addWeek(), function () {
            return Article::getMostDiscussedArticle();
        });

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

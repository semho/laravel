<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tiding;

class StatisticsController extends Controller
{
    public function index()
    {
        //количество статей всего
        $countArticles = Article::count();

        //количество новостей всего
        $countTidings = Tiding::count();

        //максимальное созданное количесво статей одним пользователем
        $userWithMaxValueArticles = Article::getMaxCountArticlesUser();

        //максимальная и минимальная длинна строки названия статьи
        $articleWithMaxLongName = Article::getArticleMaxLengthName();
        $articleWithMinLongName = Article::getArticleMinLengthName();

        //среднее количество статей у активных пользователей
        $avgCountArticles = Article::getAvgCountArticles();

        //выбираем статьи, которые хоть раз обновлялись и забираем статьию у которой больше всех обновлений
        $mostUpdateArticle = Article::getMostUpdatedArticle();

        //самая обсуждаемая статья
        $mostDiscussedArticle = Article::getMostDiscussedArticle();

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

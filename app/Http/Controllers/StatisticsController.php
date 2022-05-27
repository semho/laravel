<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tiding;
use App\Models\User;
use Illuminate\Support\Str;
use function PHPUnit\TestFixture\func;

class StatisticsController extends Controller
{
    public function index()
    {
        //количество статей всего
        $countArticles = Article::count();

        //количество новостей всего
        $countTidings = Tiding::count();

        //каждому пользователю присваиваем ключ-значение количества созданных им статей
        $users = User::with(['articles'])->get()->each(function ($user){
            $user['count'] = $user->articles->count();
            return $user;
        });
        //максимальное созданное количесво статей одним пользователем
        $maxValueAricles = $users->max('count');
        //первое вхождение по максимальному количеству статей
        $userWithMaxValueArticles = '';
        foreach ($users as $user) {
            if ($user->count == $maxValueAricles) {
                $userWithMaxValueArticles = $user;
            }
        }

        //добаляем поле длинны названия статьи
        $longestArticles = Article::select(['name', 'slug'])->get()->each(function ($article) {
            $article['length'] = Str::of($article->name)->length();
            return $article;
        });
        //максимальное длинна названия строки
        $maxLongNameAricles = $longestArticles->max('length');
        //первое вхождение по максимальной длинне строки
        $articleWithMaxLongName = '';
        foreach ($longestArticles as $item) {
            if ($item->length == $maxLongNameAricles) {
                $articleWithMaxLongName = $item;
            }
        }

        return view('layout.statistics', [
            'countArticles' => $countArticles,
            'countTidings' => $countTidings,
            'userWithMaxValueArticles' => $userWithMaxValueArticles,
            'articleWithMaxLongName' => $articleWithMaxLongName,
        ]);
    }

}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //создаем 5 пользлователей и перебираем их
        \App\Models\User::factory(5)->create()->each(function ($user) {
            //создаем 10 статей на каждого пользователя
            $article = \App\Models\Article::factory(10)->make(['owner_id' => $user->id]);
            //создаем по 7 новостей на каждого пользователя
            $tiding = \App\Models\Tiding::factory(7)->make(['owner_id' => $user->id]);
            //добавяляем их к связи с пользователем
            $user->articles()->saveMany($article);
            $user->tidings()->saveMany($tiding);
            //каждую статью перебираем
            $article->each(function ($article) {
                //и к ней привязываем случайное количество тегов со случайными значениями от 0 до 5 записи
                $article->tags()->attach(
                    \App\Models\Tag::all()->take(5)->random(rand(1,5))->pluck('id')->toArray()
                );
            });
            //каждую новость перебираем
            $tiding->each(function ($tiding) {
                //и к ней привязываем случайное количество тегов со случайными значениями от 5 до 10 записи
                $tiding->tags()->attach(
                    \App\Models\Tag::all()->skip(5)->take(5)->random(rand(1,5))->pluck('id')->toArray()
                );
            });
        });

    }
}

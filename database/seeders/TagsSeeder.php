<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //создаем 5 тегов
        \App\Models\Tag::factory(5)->create();
    }
}

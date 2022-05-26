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
        //создаем 10 тегов
        \App\Models\Tag::factory(10)->create();
    }
}

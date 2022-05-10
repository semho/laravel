<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Support\Collection;

class TagsSynchronizer
{

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

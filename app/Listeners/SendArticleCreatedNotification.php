<?php

namespace App\Listeners;

use App\Mail\ArticleCreated;

class SendArticleCreatedNotification
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(\App\Events\ArticleCreated $event)
    {
        \Mail::to(config('mail.admin_mail', false))->send(
            new ArticleCreated($event->article)
        );
    }
}

<?php

namespace App\Listeners;

use App\Events\ArticleUpdated;

class SendArticleUpdatedNotification
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ArticleUpdated $event)
    {
        \Mail::to(config('mail.admin_mail', false))->send(
            new \App\Mail\ArticleUpdated($event->article)
        );
    }
}

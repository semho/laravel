<?php

namespace App\Listeners;

use App\Events\ArticleDeleted;

class SendArticleDeletedNotification
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ArticleDeleted $event)
    {
        \Mail::to(config('mail.admin_mail', false))->send(
            new \App\Mail\ArticleDeleted($event->article)
        );
    }
}

<?php

namespace App\Listeners;

use App\Events\ArticleDeleted;
use App\Mail\ArticleCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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

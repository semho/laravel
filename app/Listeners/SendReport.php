<?php

namespace App\Listeners;

use App\Mail\Report;
use App\Models\User;

class SendReport
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(\App\Events\ReportGenerated $event)
    {
        \Mail::to($event->user->email)->send(
            new Report($event->data)
        );
    }
}

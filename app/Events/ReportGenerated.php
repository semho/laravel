<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ReportGenerated
{
    use Dispatchable, SerializesModels;

    public $data;
    public $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data, User $user)
    {
        $this->data = $data;
        $this->user = $user;
    }
}

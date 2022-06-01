<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Role;
use App\Models\Article;

class ArticleUpdatedBySocketForAdmin implements ShouldBroadcast
{
    use Dispatchable,
        InteractsWithSockets,
        SerializesModels;

    public $article;
    public $user;
    public $lastChange;

    public function __construct($article, $user)
    {
        $this->article = $article;
        $this->user = $user;
        $this->lastChange = Article::lastChangeInHistory($article);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('articleUpdated');
    }

    public function broadcastWith()
    {
        return ['article' => $this->article, 'lastChange' => $this->lastChange];
    }

    public function broadcastWhen()
    {
        return Role::isAdmin($this->user);
    }
}

<?php

namespace App\Events;

use App\Todo;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TodoChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // To-Do List related to the event
    public $list;

    // User who fired the event
    public $user;

    // Changelog information
    public $change;

    // Recipients array / or just 1 recipient
    public $recipients;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Todo $list, User $user, $recipients, $change)
    {
        $this->list = $list;
        $this->user = $user;
        $this->change = $change;
        $this->recipients = $recipients;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

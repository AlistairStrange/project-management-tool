<?php

namespace App\Events;

use App\User;
use App\Ticket;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TicketChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // Ticket related to the event
    public $ticket;

    // User who fired the event
    public $user;

    // Changelog information
    public $change;

    // Recipients array
    public $recipients;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket, User $user, $recipients, $change)
    {
        $this->ticket = $ticket;
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

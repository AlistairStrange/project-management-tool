<?php

namespace App\Events;

use App\User;
use App\Ticket;
use App\Comment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CommentNotifications
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // Actual ticket informations
    public $comment;

    // Ticket where the comment was added to
    public $ticket;

    // User who added the comment
    public $user;

    // Array of receipients - usually assignee of the ticket,
    //  requestor and optionally original comment author (if this is the reply)
    public $recipients;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket, User $user, Comment $comment, $recipients)
    {
        $this->ticket = $ticket;
        $this->comment = $comment;
        $this->user = $user;
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

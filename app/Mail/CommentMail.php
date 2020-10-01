<?php

namespace App\Mail;

use App\User;
use App\Ticket;
use App\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public $comment;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket, User $user, Comment $comment)
    {
        $this->ticket = $ticket;
        $this->user = $user;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.comments.markdown');
    }
}

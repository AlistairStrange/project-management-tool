<?php

namespace App\Mail;

use App\User;
use App\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TicketChangedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public $user;
    public $change;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket, User $user, $change)
    {
        $this->ticket = $ticket;
        $this->user = $user;
        $this->change = $change;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.tickets.markdown');
    }
}

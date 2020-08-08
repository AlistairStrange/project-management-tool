<?php

namespace App\Mail;

use App\Todo;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TodoChangedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $list;
    public $user;
    public $change;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Todo $list, User $user, $change)
    {
        $this->list = $list;
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
        return $this->markdown('emails.todos.markdown');
    }
}

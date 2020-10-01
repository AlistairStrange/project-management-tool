<?php

namespace App\Listeners;

use App\Mail\CommentMail;
use App\Events\CommentNotifications;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailNotificationComment
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CommentNotifications  $event
     * @return void
     */
    public function handle(CommentNotifications $event)
    {
        // Send E-mail
        foreach ($event->recipients as $recipient) {
            Mail::to($recipient)->send(new CommentMail($event->ticket, $event->user, $event->comment));
        }
    }
}

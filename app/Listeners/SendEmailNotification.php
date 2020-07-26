<?php

namespace App\Listeners;

use App\Events\TicketChanged;
use App\Mail\TicketChangedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailNotification implements ShouldQueue
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
     * @param  TicketChanged  $event
     * @return void
     */
    public function handle(TicketChanged $event)
    {
        // The event is queuable in order to be able run it in background
        // php artisan queue:work is required or run 'SUPERVISE'
        // Data passed to Event can be access using $event->ticket or $event->user
        
        // Send E-mail
        foreach ($event->recipients as $recipient) {
            Mail::to($recipient)->send(new TicketChangedMail($event->ticket, $event->user, $event->change));
        }
    }
}

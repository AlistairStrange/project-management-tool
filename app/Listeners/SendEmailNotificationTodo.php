<?php

namespace App\Listeners;

use App\Events\TodoChanged;
use App\Mail\TodoChangedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailNotificationTodo
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
     * @param  TodoChanged  $event
     * @return void
     */
    public function handle(TodoChanged $event)
    {
        // The event is queuable in order to be able run it in background
        // php artisan queue:work is required or run 'SUPERVISE'
        // Data passed to Event can be access using $event->ticket or $event->user
    
        // Send E-mail
        foreach ($event->recipients as $recipient) {
            Mail::to($recipient)->send(new TodoChangedMail($event->list, $event->user, $event->change));
        }
    }
}

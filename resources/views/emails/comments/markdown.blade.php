@component('mail::message')
# Ticketify Notification

Ticket {{ $ticket->projectBoard->abbreviation }}-{{ $ticket->id }}: {{ $ticket->name }} has been commented by {{ $user->name }}.

## {{ $user->name }} says:
##### {{ $comment->content }}

@component('mail::button', ['url' => route('ticket.show', $ticket->id) . '#comment-section'])
View Comment
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

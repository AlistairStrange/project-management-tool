@component('mail::message')
# Ticketify Notification

Ticket {{ $ticket->projectBoard->abbreviation }}-{{ $ticket->id }}: {{ $ticket->name }} has been changed by {{ $user->name }}.

## Changelog:
@if(is_array($change))
    @foreach($change as $attr => $val)
        {{ $attr }}: {{ $val }},
    @endforeach
@else
    {{ $change }}
@endif


@component('mail::button', ['url' => route('ticket.show', $ticket->id)])
View Ticket
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

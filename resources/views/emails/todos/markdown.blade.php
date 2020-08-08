@component('mail::message')
# Ticketify Notification

To-Do List '{{ $list->subject }}' in ticket {{ $list->ticket->projectBoard->abbreviation }}-{{ $list->ticket->id }} was {{ count($list->items) || ($list->deleted_at !== null> 0) ? 'updated' : 'created' }} by {{ $user->name }}.

## Changelog:
{{ $change }}

 @if($list->completed)
    ### Completed items:
    @foreach($list->items as $item)
        ✓ {{ $item->description }}
    @endforeach
@elseif(count($list->items) > 0 && !$list->completed)
    ### List items:
    @foreach($list->items as $item)
        - {{ $item->description }}
    @endforeach
@endif


@component('mail::button', ['url' => route('ticket.show', $list->ticket->id)])
View List
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

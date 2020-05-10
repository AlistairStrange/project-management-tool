<div class="container mx-auto">
    <div class="max-w-sm rounded overflow-hidden shadow-lg bg-gray-200 text-gray-700 mx-4 mt-3 float-left">
        <div class="px-6 py-4">
            <a href="{{ route('ticket.show', $ticket->id) }}">
                <h2 class="font-thin">{{$ticket->subject}}</h2>
            </a>
        </div>

        <!-- PLACEHOLDER show priority &  -->

        <div class="px-6 py-4">
            <p class="inline-block text-xs text-gray-600"><span class="font-semibold">Due: </span>{{ $ticket->deadline }}</p>
            <p class="inline-block text-xs text-gray-600 items-center bg-gray-300 rounded-md px-2 py-1 float-right">
                ID: ticket-{{ $ticket->id }}
            </p>
        </div>

        <!-- Moving ticket to adjacent status -->
        @if (isset($ticket->status) && $ticket->status === 'Open') 
            <a href="#" >
                <p class="bg-gray-400 text-lg text-center text-white px-6">🠪</p>
            </a>
        @elseif (isset($ticket->status) && $ticket->status === 'Closed')
            <a href="#" >
                <p class="bg-gray-400 text-lg text-center text-white px-6">⟲</p>
            </a>
        @else
            <a href="#" >
                <p class="bg-gray-400 text-lg text-center text-white w-1/2 float-left border-r border-white">🠨</p>
            </a>

            <a href="#">
                <p class="bg-gray-400 text-lg text-center text-white w-1/2 float-right">🠪</p>
            </a>
        @endif
        
    </div>
</div>
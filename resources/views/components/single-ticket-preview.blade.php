<div class="container mx-auto">
    <div class="max-w-sm rounded overflow-hidden shadow-lg bg-gray-200 text-gray-700 mx-4 mt-3 float-left">
    
        <div class="float-left py-2 pl-2">
            @switch($ticket->priority)
                @case('minimal')
                    <!-- Minimal -->
                    <p class="float-left pr-1 text-md font-semibold text-green-500 mx-auto">⇿</p>
                    @break
                @case('minor')
                    <!-- Minor -->
                    <p class="float-left pr-1 text-xs text-green-500 mx-auto">▲</p>
                    @break
                @case('major')
                    <!-- Major -->
                    <p class="float-left pr-1 text-xs text-red-500 mx-auto">▲</p>
                    @break
                @case('urgent')
                    <!-- Urgent -->
                    <p class="float-left pr-1 text-xs mx-auto">❗</p>
                    @break
                @case('blocker')
                    <!-- Blocker -->
                    <p class="float-left pr-1 text-xs text-red-600 font-bold mx-auto">Ø</p>
                    @break
            @endswitch
        </div>

        <div class="py-2 float-right">
            <a href="{{ route('ticket.show', $ticket->id) }}">
                <p class="font-thin text-sm">{{substr($ticket->subject, 0, 25) . '...'}}</p>
            </a>
        </div>

        <div class="container px-2 pt-4 pb-2 grid grid-cols-2">
            <div class="col-span-1">
                <p class="text-xs text-gray-600 bg-gray-300 rounded-md text-center float-left py-1 px-1">
                    ID: ticket-{{ $ticket->id }}
                </p>
            </div>

            <div class="col-span-1">
                <p class="text-xs text-gray-600 float-right px-1 py-1"><span class="font-semibold">Due: </span>{{ $ticket->deadline }}</p>
            </div>
        </div>



        <div class="container">
            <!-- TICKET NAVIGATION -->
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
</div>
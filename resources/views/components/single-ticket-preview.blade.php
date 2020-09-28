<div class="container mx-auto">
    <div class="max-w-sm rounded overflow-hidden shadow-md hover:shadow-lg border border-opacity-500 hover:border-teal-300 bg-cool-gray-200 text-gray-700 mx-4 mt-3 lg:float-left">
    
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
                    @if(isset($ticket->projectBoard))
                        {{ $ticket->projectBoard->abbreviation }}-{{ $ticket->id }}
                    @endif
                </p>

                <p class="text-xs text-gray-600 bg-gray-300 rounded-md text-center float-left py-1 px-1 ml-3">
                    @if(isset($ticket->story_points))
                        {{ $ticket->story_points }} p.
                    @endif
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
                <a href="{{ route('status-next', $ticket->id) }}" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8"
                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right bg-gray-400 hover:bg-teal-400 text-center text-white w-full float-left rounded">
                        <line x1="5" y1="12" x2="19" y2="12"/>
                        <polyline points="12 5 19 12 12 19"/>
                    </svg>
                </a>
            @elseif (isset($ticket->status) && $ticket->status === 'Closed')
                <a href="{{ route('status-previous', $ticket->id) }}" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8"
                     stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-ccw bg-gray-400 hover:bg-red-400 text-center text-white w-full float-left rounded">
                        <polyline points="1 4 1 10 7 10"/>
                        <polyline points="23 20 23 14 17 14"/>
                        <path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"/>
                     </svg>
                </a>
            @else
                <a href="{{ route('status-previous', $ticket->id) }}" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8"
                     stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left bg-gray-400 hover:bg-red-400 text-center text-white w-1/2 float-left border-r border-white rounded">
                        <line x1="19" y1="12" x2="5" y2="12"/>
                        <polyline points="12 19 5 12 12 5"/>
                     </svg>
                </a>
    
                <a href="{{ route('status-next', $ticket->id) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8"
                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right bg-gray-400 hover:bg-teal-400 text-center text-white w-1/2 float-right rounded">
                        <line x1="5" y1="12" x2="19" y2="12"/>
                        <polyline points="12 5 19 12 12 19"/>
                    </svg>
                </a>
            @endif
        </div>
        
    </div>
</div>
@if($tickets)
    <div class="container mx-auto mt-8 h-full-1/2">
        <div class="flex flex-wrap justify-center">
            <div class="w-full max-w-sm">
                <div class="flex flex-col break-words border border-2 rounded shadow-md hover:shadow-lg">
                    <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                        Latest Tickets
                    </div>
                    @foreach($tickets as $ticket)
                        <ul class="bg-none">
                            <li>
                                <div class="bg-gray-100 bg-opacity-25 text-sm hover:bg-gray-200 py-2 px-4 grid grid-cols-5">
                                    <a href="{{route('ticket.show', $ticket)}}" class="col-span-4 hover:text-teal-500">
                                        <span class="block mb-1 text-teal-500">
                                            {{ $ticket->projectBoard->abbreviation }}-{{ $ticket->id }}
                                        </span>

                                        <span>
                                            {{ substr($ticket->subject, 0, 30) }}
                                            @if(strlen($ticket->subject) > 30)
                                                ...
                                            @endif
                                        </span>                                                
                                    </a>

                                    <div class="col-span-1">
                                        <a href="{{route('ticket.show', $ticket)}}#comment-section" class="block text-sm font-semibold text-gray-500 hover:text-gray-600">                                    
                                            <span class="float-right">
                                                {{ $ticket->comments->count() }}
                                            </span>

                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square inline float-right">
                                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                                            </svg>

                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@else
    <div class="container mx-auto mt-8">
        <div class="flex flex-wrap justify-center">
            <div class="w-full max-w-sm">
                <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">
                    <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                        Latest Tickets
                    </div>
                        <p class="py-4 text-gray-500 mx-auto">
                            No tickets yet!
                        </p>
                </div>
            </div>
        </div>
    </div>
@endif
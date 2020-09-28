@if($comments)
    <div class="container mx-auto mt-8">
        <div class="flex flex-wrap justify-center">
            <div class="w-full max-w-sm">
                <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md hover:shadow-lg">
                    <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                        Latest Comments
                    </div>
                    @foreach($comments as $comment)
                        <ul class="bg-none">
                            <li>
                                <div class="bg-gray-100 bg-opacity-25 text-sm hover:bg-gray-200 py-2 px-4 grid grid-cols-5">
                                    <a href="{{route('ticket.show', $comment->ticket)}}#comment-section" class="col-span-4 hover:text-teal-500">
                                        <span class="block mb-1 text-teal-500">
                                            {{ $comment->user->name }}
                                        </span>

                                        <span>
                                            {{ substr($comment->content, 0, 30) }}
                                            @if(strlen($comment->content) > 30)
                                                ...
                                            @endif
                                        </span>                                                
                                    </a>

                                    <div class="col-span-1">
                                        <a href="{{route('ticket.show', $comment->ticket)}}" class="block text-sm font-semibold text-gray-500 hover:text-teal-500">                                    
                                            <span class="float-right">
                                                {{ $comment->ticket->projectBoard->abbreviation }}-{{ $comment->ticket->id }}
                                            </span>
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
                        Latest Comments
                    </div>
                        <p class="py-4 text-gray-500 mx-auto">
                            No comments yet!
                        </p>
                </div>
            </div>
        </div>
    </div>
@endif

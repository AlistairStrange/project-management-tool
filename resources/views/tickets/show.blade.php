@extends('layouts.app')

@section('content')
    <div class="grid grid-flow-row">
       <div class="container mx-auto">
           <div class="px-6 py-4">               
               <div class="mx-auto flex overflow-hidden">
                   <div class="flex-none bg-teal-400 rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden">
                        <ul class="grid grid-cols-1 items-center divide-y divide-gray-400 text-white">
                            <a class="hover:bg-teal-600" href="{{ route('edit-ticket', $ticket->id) }}">
                                <li class="m-4 col-span-1">
                                    Edit
                                </li>
                            </a>
    
                            <li class="hover:bg-teal-600 dropdown relative py-3 col-span-1">
                                Actions
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down inline">
                                    <polyline points="6 9 12 15 18 9"/>
                                 </svg>

                                <div class="container absolute hidden dropdown-menu bg-cool-gray-400 rounded">
                                        <!-- Previous STATUS -->
                                        @if($ticket->status !== 'Open')
                                            <a class="block py-4 hover:bg-cool-gray-500 text-sm" href="{{ route('status-previous', $ticket) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left inline">
                                                    <polyline points="15 18 9 12 15 6"/>
                                                </svg>
                                                @switch($ticket->status)
                                                    @case('Closed')
                                                        Re-Open
                                                        @break
                                                    @case('In Review')
                                                        Back to QA
                                                        @break
                                                    @case('QA')
                                                        Needs Work
                                                        @break
                                                    @case('In Progress')
                                                        Back to Open
                                                        @break
                                                @endswitch
                                            </a>
                                        @endif

                                        @if($ticket->status !== 'Closed')
                                            <a class="block py-4 hover:bg-cool-gray-500 text-sm" href="{{ route('status-next', $ticket) }}">
                                                <!-- NEXT STATUS -->
                                                @switch($ticket->status)
                                                    @case('Open')
                                                        Start work
                                                        @break
                                                    @case('In Review')
                                                        Close
                                                        @break
                                                    @case('QA')
                                                        To Review
                                                        @break
                                                    @case('In Progress')
                                                        Ready for QA
                                                        @break
                                                @endswitch
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right inline">
                                                    <polyline points="9 18 15 12 9 6"/>
                                                </svg>
                                            </a>       
                                        @endif 
                                </div>
                            </li>
    
                            <form class="hover:bg-teal-600" action="{{ route('ticket.destroy', $ticket->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <li class="m-4 col-span-1">
                                    <button type="submit">Delete</button>
                                </li>
                            </form>
    
                            <a class="hover:bg-teal-600" href="#comment-section">
                                <li class="m-4 col-span-1">
                                    Comment
                                </li>
                            </a>

                            <a class="hover:bg-teal-600" href="{{ route('users-tickets') }}">
                                <li class="m-4 col-span-1">
                                    All my tickets
                                </li>
                            </a>
                        </ul>
                   </div>
                   <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                       <div class="mb-8">
                            <p class="text-sm text-gray-600 float-right">
                                Complexity: 
                                @if($ticket->story_points)
                                    {{ $ticket->story_points }}
                                    @if($ticket->story_points == 1)
                                        point
                                    @else
                                        points
                                    @endif
                                @endif
                            </p>

                           <p class="text-sm text-gray-600 flex items-center">
                                {{ $ticket->project . '-' . $ticket->id }}
                           </p>

                           <div class="text-gray-900 font-bold text-xl mb-2">
                               {{ $ticket->subject }}

                                <a href="#comment-section" class="text-sm font-semibold text-gray-500 hover:text-gray-600 float-right">                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                     stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square inline">
                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                                    </svg>
                                    {{ $ticket->comments->count() }}
                                </a>
                           </div>

                           
                           <p class="trix-content">
                               {!! $ticket->description !!}
                           </p>

                        @include('partials._todo')


                        <div class="text-sm col-span-1 text-gray-700 mt-8">
                            <p class="font-semibold">Attachments: </p>

                            @foreach($ticket->attachments as $file)
                                <ul>
                                    <li class="text-gray-600 leading-none">
                                       <a href="{{ $file->downloadPath }}" download>
                                        ⭳  {{ $file->file_name }}
                                       </a>
                                    </li>
                                </ul>
                            @endforeach
                         </div>
                       </div>

                       <div class="grid grid-rows-1 grid-flow-col flex items-center">
                           
                           <div class="text-sm col-span-1 text-gray-700">
                               <p class="font-semibold">Assignee: </p>
                               <p class="text-gray-600 leading-none">{{ $ticket->user->email }}</p>
                            </div>
                            
                            <div class="text-sm col-span-1 text-gray-700">
                                <p class="font-semibold">Contact: </p>
                                <p class="text-gray-600 leading-none">{{ $ticket->contact }}</p>
                            </div>

                            <div class="text-sm col-span-1 text-gray-700">
                                <p class="font-semibold">Reporter: </p>
                                <p class="text-gray-600 leading-none">{{ $ticket->reporter }}</p>
                            </div>

                           <div class="text-sm col-span-1 text-gray-700">
                               <p class="font-semibold">Deadline: </p>
                               <p class="text-gray-600">{{ $ticket->deadline }}</p>
                           </div>
                       </div>

                    <!-- Comments Section -->
                   <x-comments :ticket="$ticket"></x-comments>

                   </div>
               </div>
           </div>
       </div>
    </div>
@endsection
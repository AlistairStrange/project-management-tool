@extends('layouts.app')

@section('content')
    <div class="grid grid-flow-row">
       <div class="container mx-auto">
           <div class="px-6 py-4">               
               <div class="mx-auto flex overflow-hidden">
                   <div class="flex-none bg-teal-500 rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden">
                       <!-- Ticket control options PLACEHOLDER -->
                       <!-- E.g. move to closed, in review... -->
                       <!-- Edit -->
                       <!-- Comment -->
                       <!-- etc -->
                        <ul class="grid grid-cols-1 items-center divide-y divide-gray-400 text-white">
                            <a href="{{ route('edit-ticket', $ticket->id) }}">
                                <li class="m-4 col-span-1">
                                    Edit
                                </li>
                            </a>
    
                            <a href="#">
                                <li class="m-4 col-span-1">
                                    Move to
                                </li>
                            </a>
    
                            <form action="{{ route('ticket.destroy', $ticket->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <li class="m-4 col-span-1">
                                    <button type="submit">Delete</button>
                                </li>
                            </form>
    
                            <a href="#">
                                <li class="m-4 col-span-1">
                                    Comment
                                </li>
                            </a>

                            <a href="#">
                                <li class="m-4 col-span-1">
                                    Back to my tickets
                                </li>
                            </a>
                        </ul>
                   </div>
                   <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                       <div class="mb-8">
                           <p class="text-sm text-gray-600 flex items-center">
                           Ticket ID: {{ $ticket->id }}
                           </p>
                           <div class="text-gray-900 font-bold text-xl mb-2">
                               {{ $ticket->subject }}
                               
                           </div>
                           
                           <p class="trix-content">
                               {!! $ticket->description !!}
                            </p>
                           
                       </div>

                       <div class="grid grid-rows-1 grid-flow-col flex items-center">
                           
                           <div class="text-sm col-span-1">
                               <strong>Assignee: </strong>
                               <p class="text-gray-900 leading-none">{{ $ticket->user->email }}</p>
                            </div>
                            
                            <div class="text-sm col-span-1">
                                <strong>Contact: </strong>
                                <p class="text-gray-900 leading-none">{{ $ticket->contact }}</p>
                            </div>

                            <div class="text-sm col-span-1">
                                <strong>Reporter: </strong>
                                <p class="text-gray-900 leading-none">{{ $ticket->reporter }}</p>
                            </div>

                           <div class="text-sm col-span-1">
                               <strong>Deadline: </strong>
                               <p class="text-gray-600">{{ $ticket->deadline }}</p>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
    </div>

@endsection
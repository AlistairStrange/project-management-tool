@extends('layouts.app')

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg w-3/4 mx-auto">
    <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            {{ $ticket->subject }}
        </h3>
        <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
            {{ $ticket->project . '-' . $ticket->id }}
        </p>
    </div>
    <div>
        <dl>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm leading-5 font-medium text-gray-500">
                Due Date
            </dt>
            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                {{ $ticket->deadline }}
            </dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm leading-5 font-medium text-gray-500">
                Contact
            </dt>
            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                {{ $ticket->contact }}
            </dd>
        </div>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm leading-5 font-medium text-gray-500">
            Created by
            </dt>
            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                {{ $ticket->reporter }}
            </dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm leading-5 font-medium text-gray-500">
                Complexity
            </dt>
            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                @if($ticket->story_points)
                    {{ $ticket->story_points }}
                    @if($ticket->story_points == 1)
                        point
                    @else
                        points
                    @endif
                @endif
            </dd>
        </div>

        <!-- Maind Ticket Body -->
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm leading-5 font-medium text-gray-500">
                Description
            </dt>
            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2 trix-content">
                {!! $ticket->description !!}
            </dd>
        </div>
        <div class="container mx-auto">
            @include('partials._todo')
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm leading-5 font-medium text-gray-500">
                Attachments
            </dt>
            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
            <ul class="border border-gray-200 rounded-md">
                @foreach($ticket->attachments as $file) 
                    <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm leading-5">
                        <div class="w-0 flex-1 flex items-center">
                            <!-- Heroicon name: paper-clip -->
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                            </svg>
                            <span class="ml-2 flex-1 w-0 truncate">
                                {{ $file->file_name }}
                            </span>
                        </div>
                        <div class="ml-4 flex-shrink-0">
                            <a href="{{ $file->downloadPath }}" download class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out">
                            Download
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </dd>
        <dt class="text-sm leading-5 font-medium text-gray-500">
            Comments
        </dt>
        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
            <x-comments :ticket="$ticket"></x-comments>
        </dd>
        </div>
        </dl>
    </div>
    </div>
@endsection
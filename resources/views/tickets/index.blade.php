@extends('layouts.app')


@section('content')
    @if(isset($project))
        <div class="my-6 w-full mb-8">
            <a href="{{ route('tickets', $project->abbreviation) }}" class="
            {{ isset($btnAll) && $btnAll === 1 ? "bg-teal-400 text-white hover:bg-white hover:text-teal-500" : 'text-teal-500 hover:bg-teal-400 hover:text-white'}}
            border border-teal-400 rounded text-sm ml-10 px-1 py-1">
                All tickets   
            </a>
            
            <a href="{{route('my-tickets', $project->abbreviation) }}" class="
            {{ isset($btnAll) && $btnAll === 0 ? "bg-teal-400 text-white hover:bg-white hover:text-teal-500" : "hover:bg-teal-400 hover:text-white text-teal-500" }}
            border border-teal-400 rounded text-sm  ml-5 px-1 py-1">
                Only My tickets   
            </a>

            <h2 class="text-gray-600 text-center font-bold text-2xl">{{ $project->name }}</h2>
        </div>
    @else
        <div class="my-6 w-full mb-8">
            <h2 class="text-gray-600 text-center font-bold text-2xl">My Tickets</h2>
        </div>
    @endif

    <div class="container mx-auto">

        <div class="grid grid-cols-5 flex items-center">
            <!-- Open Tickets column -->
            <div class="container mx-auto border-r border-gray-400 h-full">
                <h2 class="text-gray-600 text-center font-semibold">Open</h2>

                @foreach($openTickets as $ticket)
                    <x-single-ticket-preview :ticket="$ticket"/>
                @endforeach

            </div>

            <!-- In Progress Tickets column -->
            <div class="container mx-auto border-r border-gray-400 h-full">
                <h2 class="text-gray-600 text-center font-semibold">In Progress</h2>

                @foreach($inProgressTickets as $ticket)
                    <x-single-ticket-preview :ticket="$ticket"/>
                @endforeach

            </div>

            <!-- QA Tickets column -->
            <div class="container mx-auto border-r border-gray-400 h-full">
                <h2 class="text-gray-600 text-center font-semibold">Quality Assurance</h2>

                @foreach($qualityAssuranceTickets as $ticket)
                    <x-single-ticket-preview :ticket="$ticket"/>
                @endforeach
            </div>

            <!-- In Review Tickets column -->
            <div class="container mx-auto border-r border-gray-400 h-full">
                <h2 class="text-gray-600 text-center font-semibold">In Review</h2>

                @foreach($inReviewTickets as $ticket)
                    <x-single-ticket-preview :ticket="$ticket"/>
                @endforeach
            </div>

            <!-- Closed Tickets column -->
            <div class="container mx-auto h-full">
                <h2 class="text-gray-600 text-center font-semibold">Closed</h2>

                @foreach($closedTickets as $ticket)
                    <x-single-ticket-preview :ticket="$ticket"/>
                @endforeach
            </div>
        </div>
    </div>
@endsection
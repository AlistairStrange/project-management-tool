@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="grid grid-cols-5 flex items-center">
            <!-- Open Tickets column -->
            <div class="container mx-auto border-r border-gray-400 h-screen">
                <h2 class="text-gray-600 text-center font-semibold">Open</h2>

                @foreach($openTickets as $ticket)
                    <x-single-ticket-preview :ticket="$ticket"/>
                @endforeach

            </div>

            <!-- In Progress Tickets column -->
            <div class="container mx-auto border-r border-gray-400 h-screen">
                <h2 class="text-gray-600 text-center font-semibold">In Progress</h2>

                @foreach($inProgressTickets as $ticket)
                    <x-single-ticket-preview :ticket="$ticket"/>
                @endforeach

            </div>

            <!-- QA Tickets column -->
            <div class="container mx-auto border-r border-gray-400 h-screen">
                <h2 class="text-gray-600 text-center font-semibold">Quality Assurance</h2>

                @foreach($qualityAssuranceTickets as $ticket)
                    <x-single-ticket-preview :ticket="$ticket"/>
                @endforeach
            </div>

            <!-- In Review Tickets column -->
            <div class="container mx-auto border-r border-gray-400 h-screen">
                <h2 class="text-gray-600 text-center font-semibold">In Review</h2>

                @foreach($inReviewTickets as $ticket)
                    <x-single-ticket-preview :ticket="$ticket"/>
                @endforeach
            </div>

            <!-- Closed Tickets column -->
            <div class="container mx-auto h-screen">
                <h2 class="text-gray-600 text-center font-semibold">Closed</h2>

                @foreach($closedTickets as $ticket)
                    <x-single-ticket-preview :ticket="$ticket"/>
                @endforeach
            </div>
        </div>
    </div>
@endsection
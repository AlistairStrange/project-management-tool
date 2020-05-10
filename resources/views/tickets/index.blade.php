@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="grid grid-cols-5 flex items-center">
            <!-- Open Tickets column -->
            <div class="container mx-auto border-r border-gray-400 h-screen">
                <h2 class="text-gray-600 text-center font-semibold">Open</h2>

                <div class="container mx-auto">
                    <div class="max-w-sm rounded overflow-hidden shadow-lg">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">The Coldest Sunset</div>
                            <p class="text-gray-700 text-base">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                            </p>
                        </div>
                        
                        <div class="px-6 py-4">
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">#photography</span>
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">#travel</span>
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#winter</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- In Progress Tickets column -->
            <div class="container mx-auto border-r border-gray-400 h-screen">
                <h2 class="text-gray-600 text-center font-semibold">In Progress</h2>
            </div>

            <!-- QA Tickets column -->
            <div class="container mx-auto border-r border-gray-400 h-screen">
                <h2 class="text-gray-600 text-center font-semibold">Quality Assurance</h2>
            </div>

            <!-- In Review Tickets column -->
            <div class="container mx-auto border-r border-gray-400 h-screen">
                <h2 class="text-gray-600 text-center font-semibold">In Review</h2>
            </div>

            <!-- Closed Tickets column -->
            <div class="container mx-auto h-screen">
                <h2 class="text-gray-600 text-center font-semibold">Closed</h2>
            </div>
        </div>
    </div>
@endsection
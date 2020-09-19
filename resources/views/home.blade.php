@extends('layouts.app')

@section('content')
    <div class="mx-auto items-center w-3/4">
        <div class="mx-auto grid grid-cols-12 gap-2 w-full">
            <div class="col-span-4 w-full">
                <x-latest-tickets/>

                <x-latest-comments/>
            </div>
        
            <div class="col-span-8 w-full">
                <!-- Placeholder for Graphs & Charts -->
                <x-graph-charts/>
            </div>
        </div>
    </div>
@endsection

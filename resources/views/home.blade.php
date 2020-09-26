@extends('layouts.app')

@section('content')
    <div class="mx-auto items-center w-3/4">
        <div class="mx-auto grid sm:grid-cols-1 lg:grid-cols-12 gap-2 w-full">
            <div class="lg:col-span-4 w-full">
                <x-latest-tickets/>

                <x-latest-comments/>
            </div>
        
            <div class="lg:col-span-8 w-full">
                <x-open-vs-closed-chart/>
                <x-ticket-status-breakdown-chart/>
            </div>
        </div>
    </div>
@endsection

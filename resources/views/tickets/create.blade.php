@extends('layouts.app')

@section('content')
   <div class="grid grid-flow-row">
       <div class="container mx-auto">
            <div class="max-w-lg rounded overflow-hidden shadow-lg mx-auto">
                <div class="px-6 py-4">
                    <x-ticket-form/>
                </div>
            </div>
       </div>
   </div>
   
@endsection
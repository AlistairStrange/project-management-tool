@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/trix.css') }}">
<link href="{{ asset('css/upload.css') }}" rel="stylesheet">
@endsection

@section('content')
   <div class="grid grid-flow-row">
       <div class="container mx-auto">
            <div class="max-w-lg rounded overflow-hidden shadow-lg mx-auto">
                <div class="px-6 py-4">
                    <x-ticket-form :projects="$projects"/>
                </div>
            </div>
       </div>
   </div>

   <!-- JQUERY script for search & filter users -->
   @include('partials._usersearch')
   @include('partials._fileupload')
@endsection
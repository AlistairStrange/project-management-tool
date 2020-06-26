@extends('layouts.app')

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="grid grid-flow-row">
       <div class="container mx-auto">
            <div class="max-w-lg rounded overflow-hidden shadow-lg mx-auto">
                <div class="px-6 py-4">
                    <!-- FORM Component placeholder -->
                    <x-user-form :boards="$boards" :user="$user"/> 
                </div>
            </div>
       </div>
   </div>

    <!-- SELECT2 dropdowns -->
   <script type="text/javascript">
    $(document).ready(function() {
        $('.select2-dropdown').select2({
            width: '100%',
        });
    });
   </script>
@endsection
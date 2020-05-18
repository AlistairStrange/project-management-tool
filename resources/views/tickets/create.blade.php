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
   
       <!-- Script -->
       <script type="application/javascript">

        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
    
          $( "#user_search" ).autocomplete({
            source: function( request, response ) {
              // Fetch data
              $.ajax({
                url:"{{route('search-users')}}",
                type: 'post',
                dataType: "json",
                data: {
                   _token: CSRF_TOKEN,
                   search: request.term
                },
                success: function( data ) {
                   response( data );
                }
              });
            },
            select: function (event, ui) {
               // Set selection
               $('#user_search').val(ui.item.email); // display the selected text
               $('#userid').val(ui.item.value); // save selected id to input
               return false;
            }
          });
    
        });
    </script>
@endsection
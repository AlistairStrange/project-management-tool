<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{asset('dropzone/dist/min/dropzone.min.js')}}" type="text/javascript"></script>
    @yield('scripts')
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.9.0/themes/base/jquery-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('dropzone/dist/min/dropzone.min.css')}}">

    @yield('css')
</head>

<body class="bg-gray-100 h-screen antialiased leading-none">
    <div id="app">

        <!-- NAVIGATION - don't show for login, register & password recovery routes -->
        @auth
            <x-navigation/>
        @endauth
        
        @include('partials._status')

        @yield('content')

        <!-- MAIN TICKET SEARCH script -->
        <script type="application/javascript">
            // CSRF Token
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $(document).ready(function(){
                $( "#tickets_search" ).autocomplete({
                source: function( request, response ) {
                    // Fetch data
                    $.ajax({
                    url:"{{route('search-tickets')}}",
                    type: 'post',
                    dataType: "json",
                    data: {
                        _token: CSRF_TOKEN,
                        search: request.term
                    },
                    success: function( data ) {
                        // rendering options (label)
                        response( data );
                    }
                    });
                },
                select: function (event, ui) {
                    // Redirecting users according to a returned value
                    window.location.href = ui.item.value;
                    
                    return false;
                }
                });
            });
        </script>
    </div>
</body>
</html>

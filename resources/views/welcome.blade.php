<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ticketify</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/smoothness/jquery-ui.css" />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>
<body class="bg-gray-100 h-screen antialiased leading-none">
<div id="app" class="flex flex-col">
    <div class="min-h-screen flex items-center justify-center">
        <div class="flex flex-col justify-around h-full">
            <div>
                <h1 class="text-gray-600 text-center font-hairline tracking-wider text-5xl mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block text-teal-400" viewBox="0 0 64 64" aria-labelledby="title"
                    aria-describedby="desc" role="img" xmlns:xlink="http://www.w3.org/1999/xlink" stroke="currentColor" width="55" height="55">
                        <path data-name="layer2"
                        d="M55 18.7A6.9 6.9 0 0 1 45.3 9l-7-7L2 38.3l7 7a6.9 6.9 0 0 1 9.7 9.7l7 7L62 25.7z"
                        fill="none" stroke-miterlimit="10" stroke-width="3" stroke-linejoin="round"
                        stroke-linecap="round"></path>
                        <path data-name="layer1" d="M30.6 46a3 3 0 0 1-4.2 0L18 37.6a3 3 0 0 1 0-4.2L33.4 18a3 3 0 0 1 4.2 0l8.4 8.4a3 3 0 0 1 0 4.2z"
                        fill="none" stroke-miterlimit="10" stroke-width="3" stroke-linejoin="round"
                        stroke-linecap="round"></path>
                    </svg>
                    <span class="inline-block hover:text-teal-400">
                        Ticketify
                    </span>
                </h1>
                <h2 class="text-gray-500 hover:text-gray-600 text-center font-hairline tracking-wider text-md mb-2">
                    Ticketing & Project Management tool
                </h2>
            </div>
                @if(Route::has('login'))
                    <div class="mx-auto mt-6">
                        @auth
                            <a href="{{ url('/home') }}" class="no-underline hover:text-teal-400 text-sm font-normal text-teal-800 uppercase">{{ __('Home') }}</a>
                        @else
                            <!-- <a href="{{ route('login') }}" class="no-underline hover:text-teal-400 text-sm font-normal text-teal-800 uppercase pr-6">{{ __('Login') }}</a> -->
                            <a href="" id="login-btn" class="no-underline hover:text-teal-400 text-sm font-normal uppercase pr-6 mx-2">

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-log-in inline-block"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                                    <polyline points="10 17 15 12 10 7"/>
                                    <line x1="15" y1="12" x2="3" y2="12"/>
                                </svg>

                                {{ __('Login') }}
                            
                            </a>
                            @if (Route::has('register'))
                                <a href="" id="register-btn" class="no-underline hover:text-teal-400 text-sm font-normal uppercase mx-2">
                                
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="feather feather-edit-3 inline-block">
                                    <path d="M12 20h9"/>
                                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                                </svg>
                                
                                    {{ __('Register') }}

                                </a>
                            @endif
                        @endauth
                    </div>

                    <div id="login-container" class="hidden">
                        @include('auth.login')
                    </div>

                    <div id="register-container" class="hidden">
                        @include('auth.register')
                    </div>
                @endif
        </div>
    </div>
</div>

<script>
// Togglin on & off the reg buttons + hiding the other if needed
    $(document).ready(function() {
        $('#login-btn').click(function(e) {
            e.preventDefault();
            $('#register-btn').removeClass("text-teal-400");
            $('#login-btn').addClass("text-teal-400");
            $('#register-container').hide(400, 'swing');
            $('#login-container').toggle(400, 'swing');
        });

        $('#register-btn').click(function(e) {
            e.preventDefault();
            $('#login-btn').removeClass("text-teal-400");
            $('#register-btn').addClass("text-teal-400");
            $('#login-container').hide(400, 'swing');
            $('#register-container').toggle(400, 'swing');
        });
    });
</script>

</body>
</html>

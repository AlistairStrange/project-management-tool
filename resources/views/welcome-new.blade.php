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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.9.0/themes/base/jquery-ui.min.css" />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>

<body class="">

<!--
  Tailwind UI components require Tailwind CSS v1.8 and the @tailwindcss/ui plugin.
  Read the documentation to get started: https://tailwindui.com/documentation
-->
<div class="relative bg-white overflow-hidden">
    <svg xmlns="http://www.w3.org/2000/svg" class="lg:inline-block sm:hidden text-teal-400 float-left mx-8 my-5" viewBox="0 0 64 64" aria-labelledby="title"
    aria-describedby="desc" role="img" xmlns:xlink="http://www.w3.org/1999/xlink" stroke="currentColor" width="55" height="55">
        <path data-name="layer2"
        d="M55 18.7A6.9 6.9 0 0 1 45.3 9l-7-7L2 38.3l7 7a6.9 6.9 0 0 1 9.7 9.7l7 7L62 25.7z"
        fill="none" stroke-miterlimit="10" stroke-width="3" stroke-linejoin="round"
        stroke-linecap="round"></path>
        <path data-name="layer1" d="M30.6 46a3 3 0 0 1-4.2 0L18 37.6a3 3 0 0 1 0-4.2L33.4 18a3 3 0 0 1 4.2 0l8.4 8.4a3 3 0 0 1 0 4.2z"
        fill="none" stroke-miterlimit="10" stroke-width="3" stroke-linejoin="round"
        stroke-linecap="round"></path>
    </svg>
    <div class="max-w-screen-xl mx-auto lg:h-full">
      <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
        <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
          <polygon points="50,0 100,0 50,100 0,100" />
        </svg>
        <div class="relative pt-6 px-4 sm:px-6 lg:px-8">

        </div>
        <main class="mt-10 mx-auto lg:h-screen max-w-screen-xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-10 lg:px-8 xl:mt-15">
          <div class="sm:text-center lg:text-left">
            <h2 class="text-4xl tracking-tight leading-10 font-extrabold text-gray-900 sm:text-5xl sm:leading-none md:text-6xl">
              Ticketify
              <br class="xl:hidden">
              <span class="text-teal-400">management tool</span>
            </h2>
            <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
              Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat fugiat aliqua.
            </p>
            <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
              <div class="rounded-md shadow">
                <a href="#" id="login-btn" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-teal-400 hover:bg-teal-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo transition duration-150 ease-in-out md:py-4 md:text-lg md:px-10">
                  Log-In
                </a>
              </div>
              <div class="mt-3 sm:mt-0 sm:ml-3">
                <a href="#" id="register-btn" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:text-indigo-600 hover:bg-indigo-50 focus:outline-none focus:shadow-outline-indigo focus:border-indigo-300 transition duration-150 ease-in-out md:py-4 md:text-lg md:px-10">
                  Register
                </a>
              </div>
            </div>

                <div id="register-container" class="hidden lg:-ml-56">
                    @include('auth.register')
                </div>
    
                <div id="login-container" class="hidden lg:-ml-56">
                    @include('auth.login')
                </div>
          </div>


        </main>
      </div>
    </div>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
      <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80" alt="">
    </div>
  </div>  

    {{-- Toggling on & off the reg buttons + hiding the other if needed --}}
    <script>
        $(document).ready(function() {
            
            $('#login-btn').click(function(e) {
                e.preventDefault();
                // $('#register-btn').removeClass("text-teal-400");
                // $('#login-btn').addClass("text-teal-400");
                $('#register-container').hide(400, 'swing');
                $('#login-container').toggle(400, 'swing');
            });

            $('#register-btn').click(function(e) {
                e.preventDefault();
                // $('#login-btn').removeClass("text-teal-400");
                // $('#register-btn').addClass("text-teal-400");
                $('#login-container').hide(400, 'swing');
                $('#register-container').toggle(400, 'swing');
            });
        });
    </script>
</body>

<nav class="flex items-center justify-between flex-wrap bg-teal-400 p-6 mb-5">
    <div class="flex items-center flex-shrink-0 text-white mr-6">
        <a href="{{ route('home') }}" class="flex">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" aria-labelledby="title"
        aria-describedby="desc" role="img" xmlns:xlink="http://www.w3.org/1999/xlink" stroke="currentColor" width="24" height="24">
                <path data-name="layer2"
                d="M55 18.7A6.9 6.9 0 0 1 45.3 9l-7-7L2 38.3l7 7a6.9 6.9 0 0 1 9.7 9.7l7 7L62 25.7z"
                fill="none" stroke-miterlimit="10" stroke-width="3" stroke-linejoin="round"
                stroke-linecap="round"></path>
                <path data-name="layer1" d="M30.6 46a3 3 0 0 1-4.2 0L18 37.6a3 3 0 0 1 0-4.2L33.4 18a3 3 0 0 1 4.2 0l8.4 8.4a3 3 0 0 1 0 4.2z"
                fill="none" stroke-miterlimit="10" stroke-width="3" stroke-linejoin="round"
                stroke-linecap="round"></path>
            </svg>
            <span class="ml-1 font-semibold text-xl tracking-tight">Ticketify</span>
        </a>
    </div>
    <div class="block lg:hidden">
        <button class="flex items-center px-3 py-2 border rounded text-white border-teal-400  hover:border-white">
        <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
        </button>
    </div>
    <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
        <div class="text-sm">
            <!-- Dropdown for Projects - showing availaible project boards -->
            <div class="dropdown inline-block relative">
                <a href="{{ route('project.index') }}" class="block mt-4 lg:inline-block lg:mt-0 text-white  mr-4">
                    Projects
                </a>
                
                <ul class="dropdown-menu absolute hidden text-gray-700 pt-1">
                    @if($userProjectList !== null)
                        @foreach($userProjectList as $key => $name)
                            <li class="">
                                <a class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" 
                                href="{{ route('tickets', $key) }}">
                                        {{ $key . ' - ' . $name }}
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>

            <a href="{{ route('users-tickets') }}" class="block mt-4 lg:inline-block lg:mt-0 text-white  mr-4">
                My Tickets
            </a>

            <a href="{{ route('report-tickets') }}" class="block mt-4 lg:inline-block lg:mt-0 text-white  mr-4">
                Reports
            </a>
            
            
        </div>

        <form class="mx-24 flex-grow text-center" method="GET" action="{{ route('report-getData') }}">
            @csrf

            <input class="w-full text-center text-gray-500 py-1 px-3 pr-8 rounded leading-none focus:outline-none
             focus:bg-white border focus:border-purple-500 focus:shadow-outter" type="text" name="search" id="tickets_search"
              placeholder="Search the tickets - description, contacts, reporters etc...">

            <svg class="text-gray-500 absolute float-right -ml-8 mt-1 inline" xmlns="http://www.w3.org/2000/svg" width="18" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
             stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
        </form>


            
        <div class="text-right">
            <a href="{{ route('create-ticket') }}" class="inline-block text-sm px-4 py-2 mr-4 leading-none border rounded text-white border-white
                hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0 font-semibold">
                Create a ticket
            </a>
            @guest
                <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                @if (Route::has('register'))
                    <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
            @else                   
            <span class="text-white text-sm pr-4">{{ Auth::user()->name }}</span>
            
            {{-- USER management if USER is admin ONLY --}}
            <a class="no-underline hover:underline text-white text-sm p-3" href="{{ route('user.index') }}">Users</a>

                <a href="{{ route('logout') }}"
                    class="no-underline hover:underline text-white text-sm p-3"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    {{ csrf_field() }}
                </form>
            @endguest
        </div>
    </div>
</nav>
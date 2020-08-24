<nav class="flex items-center justify-between flex-wrap bg-teal-500 p-6 mb-5">
    <div class="flex items-center flex-shrink-0 text-white mr-6">
        <svg class="fill-current h-8 w-8 mr-2" width="54" height="54" viewBox="0 0 54 54" xmlns="http://www.w3.org/2000/svg"><path d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z"/></svg>
        <span class="font-semibold text-xl tracking-tight">Ticketify</span>
    </div>
    <div class="block lg:hidden">
        <button class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
        <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
        </button>
    </div>
    <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
        <div class="text-sm">
            <!-- Dropdown for Projects - showing availaible project boards -->
            <div class="dropdown inline-block relative">
                <a href="{{ route('project.index') }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
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

            <a href="{{ route('users-tickets') }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
                My Tickets
            </a>

            <a href="{{ route('report-tickets') }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
                Reports
            </a>
            
            
        </div>

        <form class="mx-24 flex-grow text-center" action="post">
            @csrf

            <input class="w-full text-center text-gray-500 py-1 px-3 pr-8 rounded leading-none focus:outline-none
             focus:bg-white border focus:border-purple-500 focus:shadow-outter" type="text" name="search" id="tickets_search"
              placeholder="Search the tickets - description, contacts, reporters etc...">
        </form>


            
        <div class="text-right">
            <a href="{{ route('create-ticket') }}" class="inline-block text-sm px-4 py-2 mr-4 leading-none border rounded text-white border-white
                hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">Create a ticket</a>
            @guest
                <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                @if (Route::has('register'))
                    <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
            @else                   
            <span class="text-gray-300 text-sm pr-4">{{ Auth::user()->name }}</span>
            
            {{-- USER management if USER is admin ONLY --}}
            <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('user.index') }}">Users</a>

                <a href="{{ route('logout') }}"
                    class="no-underline hover:underline text-gray-300 text-sm p-3"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    {{ csrf_field() }}
                </form>
            @endguest
        </div>
    </div>
</nav>

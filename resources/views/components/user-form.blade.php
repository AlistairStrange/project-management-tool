<form action="{{ isset($user) ? route('user.update', $user->id) : route('user.store') }}" class="w-full max-w-md" method="POST" enctype="multipart/form-data">

    @csrf

    @if(isset($user))
        @method('PUT')
    @endif

    <div class="grid grid-cols-2 gap-2">
        <div class="mb-3 col-span-1">
            <label class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="name">
                Name
            </label>
            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 
            text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="subject" name="name"
            type="text" placeholder="User's name" value="{{ isset($user) ? $user->name : null }}">
        </div>

        <div class="mb-3 col-span-1">
            <label class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="email">
                E-mail
            </label>

            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 
            text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="email"
            type="text" placeholder="User's email" value="{{ isset($user) ? $user->email : null }}">
        </div>
    </div>

    <div class="mb-3 col-span-2">
        <label class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="projects">
            Assign to project(s)
        </label>

        <select class="select2-dropdown block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight 
        focus:outline-none focus:bg-white focus:border-gray-500" name="boards[]" multiple="multiple">
            @foreach($boards as $project)
                <option {{ isset($user) && $user->projects->contains('id', $project->id) ? 'selected' : '' }} value="{{ $project->id }}">{{ $project->abbreviation . " - " . $project->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="grid grid-cols-4 gap-4">
        <div class="mb-3 col-span-2">
            <label class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="role">
                Role
            </label>
            
            <select class="select2-dropdown block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight
             focus:outline-none focus:bg-white focus:border-gray-500">
                <option {{ isset($user) && $user->role === 'general' ? 'selected' : '' }} value="general">General user</option>
                <option {{ isset($user) && $user->role === 'coordinator' ? 'selected' : '' }} value="coordinator">Coordinator</option>
                <option {{ isset($user) && $user->role === 'pm' ? 'selected' : '' }} value="pm">Project Manager</option>
            </select>
        </div>

        <div class="mb-3 col-span-2 w-auto">
            <label class="text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="admin">
                Make admin?
            </label>
            <div class="my-3 mb-3 bg-white border-2 rounded border-gray-400 w-6 h-6 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-blue-500">
                <input class="opacity-0 absolute" type="checkbox" name="admin" {{ isset($user) && $user->isAdmin == 1 ? 'checked' : '' }} value="1" >
                <svg class="fill-current hidden w-4 h-4 text-teal-500 pointer-events-none mb-" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
            </div>
        </div>
    </div>

    <div>



        <div class="mt-5 mb-5 float-right">
            <button type="submit" class="bg-teal-500 hover:bg-blue-700 text-white font-bold p-3 rounded my-1">
                {{ isset($project) ? 'Update' : 'Create' }}
            </button>
        </div>
        
    </div>
</form>
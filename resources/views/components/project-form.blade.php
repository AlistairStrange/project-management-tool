<form action="{{ isset($project) ? route('project.update', $project->id) : route('project.store') }}" class="w-full max-w-md" method="POST" enctype="multipart/form-data">

    @csrf

    @if(isset($project))
        @method('PUT')
    @endif

    <div class="grid grid-cols-2 gap-2">
        <div class="mb-3 col-span-1">
            <label class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="subject">
                Project name
            </label>
            <input class="bg-gray-200 appearance-none border border-gray-200 rounded w-full py-2 px-4 
            text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="subject" name="name"
            type="text" placeholder="Create new Project Board" value="{{ isset($project) ? $project->name : null }}">
        </div>

        <div class="mb-3 col-span-1">
            <label class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="subject">
                Abbreviation
            </label>

            <input class="bg-gray-200 appearance-none border border-gray-200 rounded w-full py-2 px-4 
            text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="abbreviation"
            type="text" placeholder="4 characters" value="{{ isset($project) ? $project->abbreviation : null }}">
        </div>
    </div>

    <div>
    
        <div class="mb-3">
            <label class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="assignee">
                Description
            </label>
            
            <textarea class="bg-gray-200 appearance-none border border-gray-200 rounded w-full py-2 px-4 
            text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="description" cols="10" rows="5">{{ isset($project) ? $project->description : null }}</textarea>
        </div>        
    </div>

    <div>
        <div class="mb-3">
            <label class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="assignee">
                Project Manager
            </label>
            
            <select class="select2-dropdown block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight
             focus:outline-none focus:bg-white focus:border-gray-500" name="owner">
                @if(isset($owners))
                    @foreach($owners as $owner)
                        <option {{ isset($project) && $project->owner_id === $owner->id ? 'selected' : '' }} value="{{ $owner->id }}">{{ $owner->name . ' - ' . $owner->email }}</option>
                    @endforeach
                @else
                    <p>Sorry No Project managers found</p>
                @endif
            </select>
        </div>

        <div class="mt-5 mb-5 float-right">
            <button type="submit" class="bg-teal-500 hover:bg-blue-700 text-white font-bold p-3 rounded my-1">
                {{ isset($project) ? 'Update' : 'Create' }}
            </button>
        </div>
        
    </div>
</form>
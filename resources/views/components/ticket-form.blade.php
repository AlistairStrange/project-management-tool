<form action="{{ isset($ticket) ? route('ticket.update', $ticket->id) : route('ticket.store') }}" class="w-full max-w-md" method="POST" enctype="multipart/form-data">

    @csrf

    @if(isset($ticket))
        @method('PUT')
    @endif
    
    <div class="grid grid-cols-4 gap-2">
        <div class="col-span-1">
            <label class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="project">
                Project
            </label>

            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-500 py-2 px-4 pr-8 rounded leading-tight
            focus:outline-none focus:bg-white focus:border-purple-500" name="project" id="project">
                @if(isset($projects))
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ isset($ticket) && $ticket->project_board_id === $project->id ? 'selected' : '' }}>
                            {{ $project->abbreviation }} - {{ $project->name }}
                        </option>
                    @endforeach
                @else
                    {{-- Empty text - no project available --}}
                    <option value="0">n/a</option>
                @endif
            </select>
        </div>

        <div class="mb-3 col-span-3">
            <label class="block text-gray-500 font-bold mb-2 md:mb-2" for="subject">
                Subject
            </label>
    
            <input class="bg-gray-200 appearance-none border border-gray-200 rounded w-full py-2 px-4 
            text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="subject" name="subject"
             type="text" placeholder="Create new project management tool" value="{{ isset($ticket) ? $ticket->subject : null }}">
        </div>
    </div>


    <div class="mb-3">
        <label class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="subject">
            Description
        </label>
        
        <!-- TRIX rich text editor in place -->
        <input id="description" type="hidden" name="description" value="{{ isset($ticket) ? $ticket->description : null}}">
        <trix-editor class="text-gray-500 text-sm leading-snug focus:border-purple-500 border border-gray-300" input="description"></trix-editor>
    </div>

    <div>
        <div class="mb-3">
            <label class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="assignee">
                Assign To
            </label>
            
             <!-- For defining autocomplete -->
            <input class="bg-gray-200 appearance-none border border-gray-200 rounded w-full py-2 px-4 
            text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="email" id='user_search' 
            value="{{ isset($ticket) ? $ticket->user->email : null }}" placeholder="marek.jankovic@henkel.com">

            <!-- For displaying selected option value from autocomplete suggestion -->
            <input hidden class="bg-gray-200 appearance-none border border-gray-200 rounded w-full py-2 px-4 
            text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" 
            id='userid' readonly name="assignee" value="{{ isset($ticket) ? $ticket->user->id : null }}">  

        </div>

        <div class="mb-3">
            <label class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="contact">
                Contact
            </label>
            <input class="bg-gray-200 appearance-none border border-gray-200 rounded w-full py-2 px-4 
            text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="contact" name="contact" type="email"
             placeholder="Once done, contact marek@jankovic.site" value="{{ isset($ticket) ? $ticket->contact : null }}">

            <label for="document">
                Documents
            </label>
            <div class="needsclick dropzone" id="document-dropzone">
        </div>
    </div>

    <div class="grid grid-cols-5 gap-2">
        <div class="mb-3 col-span-2">
            <label class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="deadline">
                Deadline
            </label>
            <input class="bg-gray-200 appearance-none border-gray-200 rounded w-full py-2 px-4 
            text-gray-500 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="deadline" name="deadline" 
            value="{{isset($ticket) ? $ticket->deadline : null }}" type="date">
        </div>


        <div class="float-right col-span-2 ">
            <label class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="priority">
                Priority
            </label>

            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-500 py-2 px-4 pr-8 rounded leading-tight
                focus:outline-none focus:bg-white focus:border-purple-500" name="priority" id="priority">
                <option value="minimal" {{ isset($ticket) && $ticket->priority == 'minimal' ? 'selected' : '' }}>Minimal</option>
                <option value="minor" {{ isset($ticket) && $ticket->priority == 'minor' ? 'selected' : '' }}>Minor</option>
                <option value="major" {{ isset($ticket) && $ticket->priority == 'major' ? 'selected' : '' }}>Major</option>
                <option value="urgent" {{ isset($ticket) && $ticket->priority == 'urgent' ? 'selected' : '' }}>Urgent</option>
                <option value="blocker" {{ isset($ticket) && $ticket->priority == 'blocker' ? 'selected' : '' }}>Blocker</option>
            </select>
        </div>

        <div class="float-right col-span-1">
            <label class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="priority">
                SP
            </label>

            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-500 py-2 px-4 pr-8 rounded leading-tight
                focus:outline-none focus:bg-white focus:border-purple-500" name="story_points">
                <option value='1' {{ isset($ticket) && $ticket->story_points == 1 ? 'selected' : ''}}>1 p.</option>
                <option value='2' {{ isset($ticket) && $ticket->story_points == 2 ? 'selected' : ''}}>2 p.</option>
                <option value='3' {{ isset($ticket) && $ticket->story_points == 3 ? 'selected' : ''}}>3 p.</option>
                <option value='4' {{ isset($ticket) && $ticket->story_points == 4 ? 'selected' : ''}}>4 p.</option>
                <option value='5' {{ isset($ticket) && $ticket->story_points == 5 ? 'selected' : ''}}>5 p.</option>
            </select>

            <div class="mt-5 mb-5 float-right">
                <button type="submit" class="bg-teal-500 hover:bg-blue-700 text-white font-bold p-3 rounded my-1">
                    {{ isset($ticket) ? 'Update' : 'Create' }}
                </button>
            </div>
        </div>
</form>
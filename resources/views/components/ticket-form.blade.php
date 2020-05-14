
<form action="{{ isset($ticket) ? route('ticket.update', $ticket->id) : route('ticket.store') }}" class="w-full max-w-md" method="POST">
    @csrf
    
    @if(isset($ticket))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="subject">
            Subject
        </label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 
        text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="subject" name="subject"
         type="text" placeholder="Create new project management tool" value="{{ isset($ticket) ? $ticket->subject : null }}">
    </div>

    <div class="mb-3">
        <label class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="subject">
            Description
        </label>
        <textarea class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 
        text-gray-500 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="description"
            id="description" cols="30" rows="10">{{ isset($ticket) ? $ticket->description : 'Description of the ticket'}}</textarea>
    </div>

    <div>
        <div class="mb-3">
            <label class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="assignee">
                Assign To
            </label>
            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 
            text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="assignee" name="assignee" 
            type="email" placeholder="Assign to marek@jankovic.site" value="{{ isset($ticket) ? $ticket->assignee : null }}">
        </div>

        <div class="mb-3">
            <label class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="contact">
                Contact
            </label>
            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 
            text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="contact" name="contact" type="email"
             placeholder="Once done, contact marek@jankovic.site" value="{{ isset($ticket) ? $ticket->contact : null }}">
        </div>
    </div>

    <div class="grid grid-cols-4 gap-2">
        <div class="mb-3 col-span-2">
            <label class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="deadline">
                Deadline
            </label>
            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 
            text-gray-500 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="deadline" name="deadline" 
            value="{{$ticket ? $ticket->deadline : null }}" type="date">
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
    </div>

    <div class="mt-5 mb-5 float-right">
        <button type="submit" class="bg-teal-500 hover:bg-blue-700 text-white font-bold p-3 rounded float-right my-1">
            {{ isset($ticket) ? 'Update' : 'Create' }}
        </button>
    </div>
</form>

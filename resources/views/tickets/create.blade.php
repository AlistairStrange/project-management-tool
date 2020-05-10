@extends('layouts.app')

@section('content')
   <div class="grid grid-flow-row">
       <div class="container mx-auto">
            <div class="max-w-lg rounded overflow-hidden shadow-lg mx-auto">
                <div class="px-6 py-4">
                    <form action="{{ route('ticket.store') }}" class="w-full max-w-md" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="subject">
                                Subject
                            </label>
                            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 
                            text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="subject" name="subject" type="text" placeholder="Create new project management tool">
                        </div>

                        <div class="mb-3">
                            <label class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="subject">
                                Description
                            </label>
                            <textarea class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 
                            text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="description" id="description" cols="30" rows="10">Ticket's description</textarea>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-2">
                            <div class="col-span-1 mb-3">
                                <label class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="assignee">
                                    Assign To
                                </label>
                                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 
                                text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="assignee" name="assignee" type="email" placeholder="Assign to marek@jankovic.site">
                            </div>

                            <div class="col-span-1 mb-3">
                                <label class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="contact">
                                    Contact
                                </label>
                                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 
                                text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="contact" name="contact" type="email" placeholder="Once done, contact marek@jankovic.site">
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-2">
                            <div class="mb-3 col-span-2">
                                <label class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4" for="deadline">
                                    Deadline
                                </label>
                                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 
                                text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="deadline" name="deadline" type="date">
                            </div>
    
                            <div class="mt-5 mb-5 float-right col-span-1">
                                <button type="submit" class="bg-teal-500 hover:bg-blue-700 text-white font-bold p-3 rounded float-right my-1">
                                    Create
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
       </div>
   </div>
   
@endsection
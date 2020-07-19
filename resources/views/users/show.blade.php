@extends('layouts.app')

@section('content')
    <div class="grid grid-flow-row">
       <div class="mx-auto">
           <div class="px-6 py-4">               
               <div class="mx-auto flex overflow-hidden">
                   <div class="flex-none bg-teal-500 rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden">
                        <ul class="grid grid-cols-1 items-center divide-y divide-gray-400 text-white">
                            <a href="#">
                                <li class="m-4 col-span-1">
                                    All user's tickets
                                </li>
                            </a>

                            <a href="{{ route('user.edit', $user->id) }}">
                                <li class="m-4 col-span-1">
                                    Edit
                                </li>
                            </a>
    
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <li class="m-4 col-span-1">
                                    <button type="submit">Delete</button>
                                </li>
                            </form>

                        </ul>
                   </div>
                   <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal grid grid-cols-2 gap-10">
                       <div class="mb-8 col-span-1">
                           <p class="text-gray-900 font-semibold text-md mb-2">
                                {{ $user->name }}
                           </p>

                           <p class="text-gray-600 font-semibold text-sm mb-2">
                                {{ $user->email }}
                           </p>

                           <p class="text-gray-500 text-sm mb-2">
                                Created on {{ $user->created_at->format('d. m. Y') }}
                           </p>
                        
                            @if(isset($user->updated_at))
                                <p class="text-gray-500 text-sm mb-2">
                                        Updated on {{ $user->updated_at->format('d. m. Y') }}
                                </p>
                           @endif
                       </div>

                       <div class="mb-8 col-span-1">
                            <p class="text-gray-900 font-semibold text-md mb-2">
                                        Project Boards
                            </p>

                            @if($user->projects->count() > 1) 
                                @foreach($user->projects as $project)
                                    <ul>
                                        <li class="text-teal-400 hover:text-teal-600 text-sm mb-2">
                                            <a href="{{ route('tickets', $project->abbreviation) }}">
                                                {{ $project->abbreviation . " | " . $project->name }}
                                            </a>
                                        </li>
                                    </ul>
                                @endforeach

                                @elseif($user->projects->count() == 1)
                                    <a class="text-teal-400 hover:text-teal-600 text-sm mb-2" href="{{ route('tickets', $user->projects->first()->abbreviation) }}">
                                        {{ $user->projects->first()->abbreviation . " | " . $user->projects->first()->name }}
                                    </a>
                            @endif
                       </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
    </div>

@endsection
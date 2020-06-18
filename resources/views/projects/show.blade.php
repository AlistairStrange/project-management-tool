@extends('layouts.app')

@section('content')
    <div class="grid grid-flow-row">
       <div class="container mx-auto">
           <div class="px-6 py-4">               
               <div class="mx-auto flex overflow-hidden">
                   <div class="flex-none bg-teal-500 rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden">
                        <ul class="grid grid-cols-1 items-center divide-y divide-gray-400 text-white">
                            <a href="{{ route('tickets', $project->abbreviation) }}">
                                <li class="m-4 col-span-1">
                                    All project's tickets
                                </li>
                            </a>

                            <a href="{{ route('project.edit', $project->id) }}">
                                <li class="m-4 col-span-1">
                                    Edit
                                </li>
                            </a>
    
                            <form action="{{ route('project.destroy', $project->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <li class="m-4 col-span-1">
                                    <button type="submit">Delete</button>
                                </li>
                            </form>

                        </ul>
                   </div>
                   <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                       <div class="mb-8">
                           <p class="text-sm text-gray-600 flex items-center">
                          {{ $project->abbreviation }}
                           </p>
                           <div class="text-gray-900 font-bold text-xl mb-2">
                               {{ $project->name }}
                               
                           </div>
                           
                           <p class="trix-content">
                               {!! $project->description !!}
                           </p>
                           
                       </div>
                   </div>
               </div>
           </div>
       </div>
    </div>

@endsection
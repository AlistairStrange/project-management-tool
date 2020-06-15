@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-md">
        <table class="table-auto divide-y divide-gray-400">
            <thead>
                <tr class="divide-x divide-gray-400">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="pl-4 py-2">Tickets</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($projects))
                    @foreach($projects as $project)
                        <tr class="divide-x divide-gray-400">
                            <td class="px-4 py-2">
                                <a href="{{ route('project-tickets', $project->id) }}" class="hover:underline text-teal-500">
                                    {{ $project->abbreviation }}
                                </a>
                            </td>

                            <td class="px-4 py-2">
                                <a href="{{route('project.show', $project->id)}}" class="hover:underline text-teal-500">
                                    {{ $project->name }}
                                </a>
                            </td>

                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('project-tickets', $project->id) }}" class="hover:underline text-teal-500">
                                    {{ $project->tickets()->get()->count() }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <td>
                        NO PROJECT BOARDS available
                    </td>
                @endif
            </tbody>
        </table>

        <div class="text-center my-8">
            <a href="{{ route('project.create') }}">
                <button class="border border-teal-500 hover:bg-teal-500 hover:text-white text-teal-500 font-bold py-2 px-4 rounded">Start a new Project!</button>
            </a>
        </div>
    </div>
@endsection
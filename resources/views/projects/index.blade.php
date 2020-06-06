@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-md">
        <table class="table-auto divide-y divide-gray-400">
            <thead>
                <tr class="divide-x divide-gray-400">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2"># of tickets</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($projects))
                    @foreach($projects as $project)
                        <tr class="divide-x divide-gray-400">
                            <td class="px-4 py-2">{{ $project->abbreviation }}</td>
                            <td class="px-4 py-2">{{ $project->name }}</td>
                            <td class="px-4 py-2">{{ $project->tickets()->get()->count() }}</td>
                        </tr>
                    @endforeach
                @else
                    <td>
                        NO PROJECT BOARDS available
                    </td>
                @endif
            </tbody>
        </table>
    </div>
@endsection
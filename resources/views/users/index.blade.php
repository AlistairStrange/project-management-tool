@extends('layouts.app')

@section('content')
    <div class="mx-auto container">
        <table class="mx-auto table-auto divide-y divide-gray-400">
            <thead>
                <tr class="divide-x divide-gray-400">
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Role</th>
                    <th class="pl-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($users))
                    @foreach($users as $user)
                        <tr class="divide-x divide-gray-400 hover:bg-gray-200">
                            <td class="px-4 py-2">
                                <a href="{{ route('user.show', $user) }}" class="hover:underline text-teal-500">
                                    {{ $user->name }}
                                </a>
                            </td>

                            <td class="px-4 py-2 italic">
                                {{ $user->email }}
                            </td>

                            <td class="px-4 py-2">
                                @if($user->isAdmin === 1)
                                    <strong>admin</strong>, 
                                @endif
                                
                                {{ $user->role }}
                            </td>

                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('user.show', $user) }}" class="inline-block mx-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal text-gray-600 hover:text-teal-700">
                                        <circle cx="12" cy="12" r="1"/>
                                        <circle cx="19" cy="12" r="1"/>
                                        <circle cx="5" cy="12" r="1"/>
                                    </svg>
                                </a>

                                <form action="{{ route('user.destroy', $user) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="inline-block mx-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-gray-600 hover:text-red-700">
                                            <polyline points="3 6 5 6 21 6"/>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                            <line x1="10" y1="11" x2="10" y2="17"/>
                                            <line x1="14" y1="11" x2="14" y2="17"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <td>
                        No Users available
                    </td>
                @endif
            </tbody>
        </table>

        <div class="text-center my-8">
            <a href="{{ route('user.create') }}">
                <button class="border border-teal-500 hover:bg-teal-500 hover:text-white text-teal-500 font-bold py-2 px-4 rounded">Create a new user</button>
            </a>
        </div>

    </div>

@endsection
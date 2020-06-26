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
                                <a href="#" class="hover:underline text-teal-500">
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
                                <a href="{{ route('user.show', $user) }}">
                                    <button class="border-solid border-2 border-blue-500 hover:bg-blue-500 text-blue-500 hover:text-white py-1 px-2 rounded">
                                        Details
                                    </button>
                                </a>

                                <a href="#">
                                    <button class="border-solid border-2 border-red-500 hover:bg-red-500 text-red-500 hover:text-white py-1 px-2 rounded ml-2">
                                        Remove
                                    </button>
                                </a>
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
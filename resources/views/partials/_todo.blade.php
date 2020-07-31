{{-- Check if current ticket has any Todo List --}}
@if(isset($ticket->todos))
    {{-- If it does, then iterate over them and display them --}}
    <div class="m-4 grid grid-cols-3 gap-4">
        @foreach($ticket->todos as $list)
                <div class="border border-gray-300 rounded-t hover:shadow-xl hover:border-teal-400 px-4 py-4">
                    <p class="font-semibold">{{ $list->subject }}</p>
            
                    <table class="table-auto divide-y divide-gray-200 w-full">
                        <tbody>
                            {{-- If the current list has any items, iterate through them --}}
                            @if(isset($list->items))
                                @foreach($list->items as $item)
                                    <tr class="divide-x divide-gray-400 hover:bg-gray-200 w-11/12">
                                        <td  class="px-2 py-2 w-9/12 {{ $item->completed ? 'line-through text-gray-600' : '' }}">
                                            {{ $item->description }}
                                        </td>
                    
                                        <td class="pl-4 py-2">
                                            <form class="inline-block" action="{{ route('todo-item.delete', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="pr-2 text-gray-600 hover:text-gray-800" type="submit">✗</button>
                                            </form>

                                            <form class="inline-block" action="{{ route('todo-item.completed', $item->id) }}" method="POST">
                                                @csrf
                                                <button class="pr-2 text-gray-600 hover:text-gray-800" type="submit">{{ $item->completed ? '⟲' : '✓' }}</button>
                                            </form>
                                            {{-- <a class="pr-2 text-gray-600 hover:text-gray-800" href="#">✗</a>
                                            <a class="text-gray-600 hover:text-gray-800" href="#">✓</a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
            
                    <form action="{{ route('todo-item.store', $list->id) }}" method="POST">
                        @csrf

                        <div class="float-left mr-2">
                            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded py-2 px-4 
                                text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" name="itemDescription"
                                type="text" placeholder="Add new to-do item">
                        </div>
            
                        <!-- mt-6 bg-teal-400 rounded-full h-12 w-12 flex items-center justify-center text-white font-bold text-5xl pb-3 hover:bg-teal-600 mx-auto -->
                        <div class="mt-6 bg-teal-400 rounded-full h-8 w-8 flex items-center justify-center text-white font-bold text-3xl pb-2 hover:bg-teal-600 mx-auto">
                            <button type="submit">+</button>
                        </div>
                    </form>
                </div>
                @endforeach
        </div>
@endif

<div class="m-4 grid lg:grid-cols-3 md:grid-cols-2 sm-grid-cols-1 gap-4">
    <!-- Check if current ticket has any Todo List -->
    @if(isset($ticket->todos))
        <!-- If it does, then iterate over them and display them -->
        @foreach($ticket->todos as $list)
                <div class="border border-gray-300 rounded-t hover:shadow-xl hover:border-teal-400 px-4 py-4">
                    <p class="float-left font-semibold">{{ $list->subject }}</p>

                    <!-- REMOVE whole list -->
                    <form action="{{ route('todo.delete', $list->id) }}" method="POST" class="float-right text-xs">
                        @csrf
                        @method('DELETE')
                        <button type="submit">✗</button>
                    </form>

                    <!-- COMPLETE whole list / all list's items -->
                    <form action="{{ route('todo.completed', $list->id) }}" method="POST" class="mr-2 float-right text-xs">
                        @csrf
                        <button type="submit">✓</button>
                    </form>
            
                    <table class="table-auto divide-y divide-gray-200 w-full">
                        <tbody>
                            <!-- If the current list has any items, iterate through them -->
                            @if(isset($list->items))
                                @foreach($list->items as $item)
                                    <tr class="divide-x divide-gray-400 hover:bg-gray-200 w-11/12">
                                        <td  class="px-2 py-2 w-9/12 {{ $item->completed ? 'line-through text-gray-600' : '' }}">
                                            {{ $item->description }}
                                        </td>
                    
                                        <td class="pl-4 py-2">
                                            <!-- REMOVE todo item -->
                                            <form class="inline-block" action="{{ route('todo-item.delete', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="pr-2 text-gray-600 hover:text-gray-800" type="submit">✗</button>
                                            </form>

                                            <!-- COMPLETE & REOPEN todo item  -->
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
                    
                    <!-- INPUT & PLUS SIGN for new todo item ADD -->
                    <form class="mt-4" action="{{ route('todo-item.store', $list->id) }}" method="POST">
                        @csrf
                        <div class="grid xl:grid-cols-4 grid-cols-2 gap-2">
                            <div class="col-span-3 mr-2">
                                <input class="flex-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded py-2 px-2 
                                    text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" name="itemDescription"
                                    type="text" placeholder="Add new to-do item">
                            </div>
                
                            <div class="col-span-1 mt-1 bg-teal-400 rounded-full h-8 w-8 flex items-center justify-center text-white font-bold text-3xl pb-2 hover:bg-teal-600 mx-auto">
                                <button type="submit">+</button>
                            </div>
                        </div>                            
                    </form>
                </div>
        @endforeach
    @endif

    <!-- Displaying options for adding new Todo List -->
    <div class="bg-gray-100 border-dashed border-2 border-gray-300 rounded-t hover:shadow-md hover:border-teal-400 px-4 py-4 
    {{ isset($list) ? '' : 'h-56' }}">

            <form class="h-full w-full" action="{{ route('todo.store', $ticket->id) }}" method="POST">
                @csrf
                <div class="h-full w-full float">
                    <div class="col-span-3 mr-2 h-full w-full">
                        <input class="text-center flex-1 bg-gray-100 appearance-none border-2 border-gray-100 rounded py-2 px-2 
                            text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500 h-full w-full" name="listSubject"
                            type="text" placeholder="Create New To-Do list">
                    </div>
        
                    <!-- <div class="relative -m-16 z-10 bg-gray-400 rounded-full h-8 w-8 flex items-center justify-center text-white font-bold text-3xl pb-2 hover:bg-gray-600 mx-auto">
                        <button type="submit">+</button>
                    </div> -->
                </div>                            
            </form>                                

    </div>
</div>





<!-- <div class="border-dashed border-2 border-gray-300 rounded-t hover:shadow-md hover:border-teal-400 px-4 py-4">
        <div class="mx-auto my-16">
            <span class="">NEW TODO</span>

            <form class="mt-4" action="{{ route('todo.store', $ticket->id) }}" method="POST">
                @csrf
                <div class="grid grid-cols-4 gap-2">
                    <div class="col-span-3 mr-2">
                        <input class="flex-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded py-2 px-2 
                            text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" name="listSubject"
                            type="text" placeholder="Create New To-Do list">
                    </div>
        
                    <div class="col-span-1 mt-1 bg-teal-400 rounded-full h-8 w-8 flex items-center justify-center text-white font-bold text-3xl pb-2 hover:bg-teal-600 mx-auto">
                        <button type="submit">+</button>
                    </div>
                </div>                            
            </form>                                
        </div>
    </div> -->


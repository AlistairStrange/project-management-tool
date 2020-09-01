<!-- START of Comments -->
<div class="container mx-auto flex-none overflow-hidden grid grid-cols-12">
    <p class="text-gray-900 text-center my-8 font-bold text-lg mb-2">
            Comments
    </p>
    
    @if(isset($comments))
        <!-- Main Comment -->
        @foreach($comments as $comment)
            @if($comment->comment_parent_id === null)
                <div class="border border-gray-300 hover:bg-gray-100 rounded px-4 py-2 col-span-12 grid grid-cols-5 gap-2 my-1">
                    <!-- User's name -->
                    <div class="container col-span-1">
                        <p class="text-sm font-semibold text-teal-400">
                        {{ $comment->user->name }}
                        </p>
                        <p class="text-xs font-thin text-gray-500">
                        on {{ $comment->created_at }}
                        </p>
                    </div>

                    <!-- Comment's content -->
                    <div class="container col-span-4">
                        {{ $comment->content }}
                    </div>
                </div>
            @endif

            <!-- Reaction Comments -->
            @if($comment->replies->count() > 0)
                @foreach($comment->replies as $reply)
                    <div class="border border-gray-300 hover:bg-gray-100 rounded px-4 py-2 col-start-3 col-span-10 grid grid-cols-5 gap-2 my-1">
                        <!-- User's name -->
                        <div class="container col-span-1">
                            {{ $reply->user->name }}
                        </div>

                        <!-- Comment's content -->
                        <div class="container col-span-4">
                            {{ $reply->content }}
                        </div>
                    </div>
                @endforeach
            @endif
        @endforeach
    @endif

    <!--FORM New Comment -->
    <form action="{{ route('comment.store', $ticket) }}" method="post" class="col-span-12 mt-4">
        @csrf
        <textarea class="px-2 py-2 w-full hover:bg-gray-200 bg-gray-100 rounded text-gray-500" name="content" placeholder="Add new comment..."></textarea>
        <button type="submit" class="text-sm font-semibold text-teal-400 hover:text-teal-500 block float-right pt-2">+ Add comment</button>
    </form>
</div>
<!-- END of COMMENTS -->
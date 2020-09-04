<!-- START of Comments -->
<div class="container mx-auto flex-none overflow-hidden grid grid-cols-12">
    <p id="comment-section" class="text-gray-900 text-center my-8 font-bold text-lg mb-2">
            Comments
    </p>
    
    @if(isset($comments))
        <!-- Main Comment -->
        @foreach($comments as $comment)
            @if($comment->comment_parent_id === null)
                <div id="comment-{{ $comment->id }}" class="border border-gray-300 hover:bg-gray-100 rounded px-4 py-2 col-span-12 grid grid-cols-5 gap-2 my-1">
                    <!-- User's name & date-->
                    <div class="container col-span-1">
                        <p class="text-sm font-semibold text-teal-400">
                        {{ $comment->user->name }}
                        </p>

                        <p class="text-xs font-thin text-gray-500">
                        on {{ $comment->created_at }}
                        </p>
                        
                        <a href="#reply-form-{{ $comment->id }}" reply-to="reply-form-{{ $comment->id }}" class="reply-btn text-xs font-thin text-teal-400 hover:text-teal-600">Reply</a>
                    </div>
                    
                    <!-- Comment's content -->
                    <div class="container col-span-4 text-gray-600 flex">
                        {{ $comment->content }}

                        @can('delete', $comment)
                            <form action="{{ route('comment.delete', $comment) }}#comment-section" method="post" class="flex-grow">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="float-right text-gray-500 hover:text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                        <line x1="18" y1="6" x2="6" y2="18"/>
                                        <line x1="6" y1="6" x2="18" y2="18"/>
                                    </svg>
                                </button>
                            </form>
                        @endcan
                    </div>
                    
                </div>
            @endif

            <!-- Reaction Comments -->
            @if($comment->replies->count() > 0)
                @foreach($comment->replies as $reply)
                    <div id="reply-comment-{{ $reply->id }}" class="border border-gray-300 hover:bg-gray-100 rounded px-4 py-2 col-start-3 col-span-10 grid grid-cols-5 gap-2 my-1">
                        <!-- User's name & date-->
                        <div class="container col-span-1">
                            <p class="text-sm font-semibold text-teal-400">
                                {{ $reply->user->name }}
                            </p>

                            <p class="text-xs font-thin text-gray-500">
                                {{ $reply->created_at }}
                            </p>
                        </div>

                        <!-- Comment's content -->
                        <div class="container col-span-4 text-gray-600 flex">
                            {{ $reply->content }}

                            @can('delete', $reply)
                                <form action="{{ route('comment.delete', $reply) }}#comment-section" method="post" class="flex-grow">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="float-right text-gray-500 hover:text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                            <line x1="18" y1="6" x2="6" y2="18"/>
                                            <line x1="6" y1="6" x2="18" y2="18"/>
                                        </svg>
                                    </button>
                                </form>
                            @endcan

                        </div>
                    </div>
                @endforeach
            @endif

            <!-- FORM for Comment REPLY -->
            @if($comment->comment_parent_id === null)
                <form id="reply-form-{{ $comment->id }}" action="{{ route('comment.store', $ticket) }}#comment-section" method="post" class="hidden col-start-3 col-span-10 mt-4">
                    @csrf
                    <input type="hidden" name="reply" value="{{ $comment->id }}">
                    <textarea class="shadow px-2 py-2 w-full hover:bg-gray-200 bg-gray-100 rounded text-gray-500" name="content" rows="1" placeholder="Reply to comment..."></textarea>
                    <button type="submit" class="text-sm font-semibold text-teal-400 hover:text-teal-500 block float-right pt-2">+ Add reply</button>
                </form>
            @endif
        @endforeach
    @endif

    <!--FORM NEW Comment -->
    <form action="{{ route('comment.store', $ticket) }}#comment-section" method="post" class="col-span-12 mt-4">
        @csrf
        <textarea class="shadow px-2 py-2 w-full hover:bg-gray-200 bg-gray-100 rounded text-gray-500" name="content" placeholder="Add new comment..."></textarea>
        <button type="submit" class="text-sm font-semibold text-teal-400 hover:text-teal-500 block float-right pt-2">+ Add comment</button>
    </form>
</div>
<!-- END of COMMENTS -->

<!-- jQuery script for displaying the reply field for comments -->
<!-- Selecting all reply-btn classes and then on click checking his reply-to attribute -->
<!-- Then converting the attribute to ID selector and toggling on/of the visibility -->
<script>
    $(document).ready(function() {
        $(".reply-btn").click(function() {
            var id = '#' + $(this).attr("reply-to");

            $(id).toggle();
        });
    });
</script>
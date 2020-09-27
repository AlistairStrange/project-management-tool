<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateCommentValidator;

class CommentsController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCommentValidator $request, Ticket $ticket)
    {
        // Store the comment
        $comment = Comment::create([
            'content' => $request->content,
        ]);

        // Setting up relationships
        $user = Auth::user();
        $user->comments()->save($comment);
        $ticket->comments()->save($comment);

        // If it's not regular comment but reply, set parent comment relationship
        if($request->reply) {
            $parent = Comment::findOrFail($request->reply);
            $parent->replies()->save($comment);
        }

        return redirect()->back()->with('status', 'Comment added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->replies()->delete();

        $comment->delete();

        return redirect()->back()->with('status', 'Comment removed successfully');
    }
}

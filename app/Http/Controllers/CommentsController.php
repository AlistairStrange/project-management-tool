<?php

namespace App\Http\Controllers;

use App\User;
use App\Ticket;
use App\Comment;
use Illuminate\Http\Request;
use App\Events\CommentNotifications;
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
        $reply = '';

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
            $reply = $parent->user->email;
        }

        // Send E-mail Notification
        $this->sendEmailNotification($ticket, $user, $comment, $reply);

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

    public function sendEmailNotification(Ticket $ticket, User $user, Comment $comment, $reply = null)
    {
        // Get all recipients of the notification
        $recipients = [
            $ticket->reporter,
            $ticket->user->email, //assigned user
        ];

        // In case comment is a reply we notify original comment's user as well
        if($reply) {
            $recipients[] = $reply;
        }

        // Removing duplicates
        $recipients = array_unique($recipients);

        // Runs the event
        event(new CommentNotifications($ticket, $user, $comment, $recipients));

        return true;
    }
}

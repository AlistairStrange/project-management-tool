<?php

namespace App\Policies;

use App\User;
use App\Comment;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if($user->isAdmin === 1) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function delete(User $user, Comment $comment)
    {
        if ($user->id === $comment->user_id) {
            return true;
        } else {
            return Response::deny("You can't delete this comment");
        }
    }

}

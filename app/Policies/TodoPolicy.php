<?php

namespace App\Policies;

use App\Todo;
use App\User;
use App\Ticket;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class TodoPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if($user->isAdmin === 1) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        // 
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Todo  $todo
     * @return mixed
     */
    public function view(User $user, Todo $todo)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Todo  $todo
     * @return mixed
     */
    public function update(User $user, Todo $todo)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Todo  $todo
     * @return mixed
     */
    public function delete(User $user, Todo $list)
    {
        switch($user->role) {
            case "general":
                if($list->owner_id === $user->id) {
                    return true;
                    break;
                } else {
                    return Response::deny("You don't have rights to delete this To-Do list");
                    break;
                }
            case "coordinator":
                // coordinator can change status of the ticket only if it's created by him
                if ($list->ticket->reporter === $user->email) {
                    return true;
                    break;
                } else {
                    return Response::deny("You don't have rights to delete To-Do lists on this ticket");
                    break;
                }
            case "pm":
                // Project maanager can update the ticket only within Project Board assigned to him / or where he's assigned as a PM
                if($list->ticket->projectBoard->owner_id === $user->id) {
                    return true;
                    break;
                } else {
                    return Response::deny("You can't delete To-Do lists on tickets in '" . $ticket->projectBoard->name . "' - You are not assigned PM of this board.");                
                    break;
                }
        }
    }

    /**
     * Determine whether the user can delete the whole To-Do list / item
     *
     * @param User $user
     * @param Ticket $ticket
     * @return void
     */
    public function completed(User $user, Todo $list)
    {
        switch($user->role) {
            case "general":
                if($list->ticket->assignee_id === $user->id || $list->owner_id === $user->id) {
                    return true;
                    break;
                } else {
                    return Response::deny("You don't have rights to change status of To-Do lists on this ticket");
                    break;
                }
            case "coordinator":
                // coordinator can change status of the ticket only if it's created by him
                if ($list->ticket->reporter === $user->email || $list->owner_id === $user->id) {
                    return true;
                    break;
                } else {
                    return Response::deny("You don't have rights to change status of To-Do lists on this ticket");
                    break;
                }
            case "pm":
                // Project maanager can update the ticket only within Project Board assigned to him / or where he's assigned as a PM
                if($$list->ticket->projectBoard->owner_id === $user->id || $list->owner_id === $user->id) {
                    return true;
                    break;
                } else {
                    return Response::deny("You can't change status of To-Do lists on tickets in '" . $ticket->projectBoard->name . "' - You are not assigned PM of this board.");                
                    break;
                }
        }
    }
}

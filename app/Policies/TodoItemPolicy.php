<?php

namespace App\Policies;

use App\Todo;
use App\User;
use App\TodoItem;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class TodoItemPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if($user->isAdmin == 1) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // CREATE policy for items is implemented in TodoPolicy->addItem method.
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\TodoItem  $todoItem
     * @return mixed
     */
    public function delete(User $user, TodoItem $item)
    {
        switch($user->role) {
            case "general":
                if($item->todo->owner_id == $user->id || $item->todo->ticket->assignee_id == $user->id) {
                    return true;
                    break;
                } else {
                    return Response::deny("You can't delete this item");
                    break;
                }
            case "coordinator":
                if($item->todo->owner_id == $user->id || $item->todo->ticket->reporter == $user->id) {
                    return true;
                    break;
                } else {
                    return Response::deny("You can't delete this item");
                    break;
                }
            case "pm":
                if(in_array($user->id, $item->todo->ticket->projectBoard->users->pluck('id')->toArray())|| $item->todo->owner_id == $user->id) {
                    return true;
                    break;
                } else {
                    return Response::deny("You can't delete this item");
                    break;
                }
        }
    }

    /**
     * Determine whether user can complete the item
     *
     * @param User $user
     * @param TodoItem $todoItem
     * @return void
     */
    public function completed(User $user, TodoItem $item)
    {
        switch($user->role) {
            case "general":
                if($item->todo->owner_id == $user->id || $item->todo->ticket->assignee_id == $user->id) {
                    return true;
                    break;
                } else {
                    return Response::deny("You can't complete this item");
                    break;
                }
            case "coordinator":
                if($item->todo->owner_id == $user->id || $item->todo->ticket->reporter == $user->id) {
                    return true;
                    break;
                } else {
                    return Response::deny("You can't complete this item");
                    break;
                }
            case "pm":
                if(in_array($user->id, $item->todo->ticket->projectBoard->users->pluck('id')->toArray()) || $item->todo->owner_id == $user->id) {
                    return true;
                    break;
                } else {
                    return Response::deny("You can't complete this item");
                    break;
                }
        }

    }

}

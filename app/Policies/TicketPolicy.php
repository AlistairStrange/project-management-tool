<?php

namespace App\Policies;

use App\Ticket;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
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
     * @param  \App\Ticket  $ticket
     * @return mixed
     */
    public function view(User $user, Ticket $ticket)
    {
        // Verifying whether user is assigned to the project
        return ($user->projects->contains('id', $ticket->projectBoard->id));

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        switch($user->role) {
            case "general":
                return false;
                
                break;
            case "coordinator":
                return true;
                break;
            case "pm":
                return true;
                break;
        }

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Ticket  $ticket
     * @return mixed
     */
    public function update(User $user, Ticket $ticket)
    {
        switch($user->role) {
            case "general":
                return false;
                break;
            case "coordinator":
                // coordinator can update the ticket only if it's created by him
                if ($ticket->reporter === $user->email) {
                    return true;
                    break;
                } else {
                    return false;
                    break;
                }
            case "pm":
                // Project maanager can update the ticket only within Project Board assigned to him / or where he's assigned as a PM
                if($ticket->projectBoard->owner_id === $user->id) {
                    return true;
                    break;
                } else {
                    return false;
                    break;
                }
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Ticket  $ticket
     * @return mixed
     */
    public function delete(User $user, Ticket $ticket)
    {
        switch($user->role) {
            case "general":
                return false;
                break;
            case "coordinator":
                return false;
                break;
            case "pm":
                // Project maanager can delete the ticket only within Project Board assigned to him / or where he's assigned as a PM
                if($ticket->projectBoard->owner_id === $user->id) {
                    return true;
                    break;
                } else {
                    return false;
                    break;
                }
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Ticket  $ticket
     * @return mixed
     */
    public function restore(User $user, Ticket $ticket)
    {
        switch($user->role) {
            case "general":
                return false;
                break;
            case "coordinator":
                return false;
                break;
            case "pm":
                // Project maanager can restore the ticket only within Project Board assigned to him / or where he's assigned as a PM
                if($ticket->projectBoard->owner_id === $user->id) {
                    return true;
                    break;
                } else {
                    return false;
                    break;
                }
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Ticket  $ticket
     * @return mixed
     */
    public function forceDelete(User $user, Ticket $ticket)
    {
        return false;
    }

    /**
     * Determine whether the user can change the status of the model (ticket)
     *
     * @return void
     */
    public function statusChange(User $user, Ticket $ticket)
    {
        switch($user->role) {
            case "general":
                if($ticket->assignee_id === $user->id) {
                    return true;
                    break;
                } else {
                    return false;
                    break;
                }
            case "coordinator":
                // coordinator can change status of the ticket only if it's created by him
                if ($ticket->reporter === $user->email) {
                    return true;
                    break;
                } else {
                    return false;
                    break;
                }
            case "pm":
                // Project maanager can update the ticket only within Project Board assigned to him / or where he's assigned as a PM
                if($ticket->projectBoard->owner_id === $user->id) {
                    return true;
                    break;
                } else {
                    return false;
                    break;
                }
        }
    }
}

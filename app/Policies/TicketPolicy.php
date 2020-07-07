<?php

namespace App\Policies;

use App\User;
use App\Ticket;
use Illuminate\Auth\Access\Response;
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
        return $user->projects->contains('id', $ticket->projectBoard->id)
                ? Response::allow()
                : Response::deny("You don't have rights to view tickets of '" . $ticket->projectBoard->name . "' project board");

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
                return Response::deny('Sorry, you do not have permission to create new tickets. Only Project managers or Coordinators can do that.');                
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
                return Response::deny('Sorry, you do not have permission to update tickets.');                
                break;
            case "coordinator":
                // coordinator can update the ticket only if it's created by him
                if ($ticket->reporter === $user->email) {
                    return true;
                    break;
                } else {
                    return Response::deny("You can't update this ticket, because it was not created by you. Ask PM's for update.");                
                    break;
                }
            case "pm":
                // Project maanager can update the ticket only within Project Board assigned to him / or where he's assigned as a PM
                if($ticket->projectBoard->owner_id === $user->id) {
                    return true;
                    break;
                } else {
                    return Response::deny("You can't edit tickets in '" . $ticket->projectBoard->name . "' - You are not assigned PM of this board.");                
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
                return Response::deny('Sorry, you do not have permission to delete any tickets');
                break;
            case "coordinator":
                return Response::deny('Sorry, you do not have permission to delete any tickets');                
                break;
            case "pm":
                // Project maanager can delete the ticket only within Project Board assigned to him / or where he's assigned as a PM
                if($ticket->projectBoard->owner_id === $user->id) {
                    return true;
                    break;
                } else {
                    return Response::deny("You can't delete tickets in '" . $ticket->projectBoard->name . "' - You are not assigned PM of this board.");                
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
                return Response::deny("General users can't restore previously deleted tickets");
                break;
            case "coordinator":
                return Response::deny("Coordinator users can't restore previously deleted tickets");
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
                    return Response::deny("Sorry, you can't move this ticket - you are not assignee of this ticket.");
                    break;
                }
            case "coordinator":
                // coordinator can change status of the ticket only if it's created by him
                if ($ticket->reporter === $user->email) {
                    return true;
                    break;
                } else {
                    return Response::deny("Sorry, you can't move this ticket. Coordinators can move only tickets created by them.");
                    break;
                }
            case "pm":
                // Project maanager can update the ticket only within Project Board assigned to him / or where he's assigned as a PM
                if($ticket->projectBoard->owner_id === $user->id) {
                    return true;
                    break;
                } else {
                    return Response::deny("You can't move tickets in '" . $ticket->projectBoard->name . "' - You are not assigned PM of this board.");                
                    break;
                }
        }
    }
}

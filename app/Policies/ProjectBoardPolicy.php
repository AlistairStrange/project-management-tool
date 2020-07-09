<?php

namespace App\Policies;

use App\User;
use App\ProjectBoard;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectBoardPolicy
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
     * @param  \App\ProjectBoard  $projectBoard
     * @return mixed
     */
    public function view(User $user, ProjectBoard $projectBoard)
    {
        return $user->projects->contains('id', $projectBoard->id)
            ? Response::allow()
            : Response::deny("Sorry, you don't have permission to view this project board.");
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\ProjectBoard  $projectBoard
     * @return mixed
     */
    public function update(User $user, ProjectBoard $projectBoard)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\ProjectBoard  $projectBoard
     * @return mixed
     */
    public function delete(User $user, ProjectBoard $projectBoard)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\ProjectBoard  $projectBoard
     * @return mixed
     */
    public function restore(User $user, ProjectBoard $projectBoard)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\ProjectBoard  $projectBoard
     * @return mixed
     */
    public function forceDelete(User $user, ProjectBoard $projectBoard)
    {
        //
    }
}

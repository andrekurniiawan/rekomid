<?php

namespace App\Policies;

use App\Tag;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Tag  $tag
     * @return mixed
     */
    public function view(User $user, Tag $tag)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        switch ($user->role) {
            case 'Subscriber':
                return false;
                break;

            default:
                return true;
                break;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Tag  $tag
     * @return mixed
     */
    public function update(User $user, Tag $tag)
    {
        switch ($user->role) {
            case 'Subscriber':
            case 'Contributor':
            case 'Author':
                return false;
                break;

            default:
                return true;
                break;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Tag  $tag
     * @return mixed
     */
    public function delete(User $user, Tag $tag)
    {
        switch ($user->role) {
            case 'Subscriber':
            case 'Contributor':
            case 'Author':
                return false;
                break;

            default:
                return true;
                break;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Tag  $tag
     * @return mixed
     */
    public function restore(User $user, Tag $tag)
    {
        switch ($user->role) {
            case 'Subscriber':
            case 'Contributor':
            case 'Author':
                return false;
                break;

            default:
                return true;
                break;
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Tag  $tag
     * @return mixed
     */
    public function forceDelete(User $user, Tag $tag)
    {
        switch ($user->role) {
            case 'Subscriber':
            case 'Contributor':
            case 'Author':
                return false;
                break;

            default:
                return true;
                break;
        }
    }
}

<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the list of posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }


    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\User  $user
     * @param  \App\User  $relatedUser
     * @return mixed
     */
    public function view(User $user, User $relatedUser)
    {
        return true;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\User  $user
     * @param  \App\User  $post
     * @return mixed
     */
    public function update(User $user, User $relatedUser)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\User  $relatedUser
     * @return mixed
     */
    public function delete(User $user, User $relatedUser)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the post.
     *
     * @param  \App\User  $user
     * @param  \App\User  $relatedUser
     * @return mixed
     */
    public function restore(User $user, User $relatedUser)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\User  $relatedUser
     * @return mixed
     */
    public function forceDelete(User $user, User $relatedUser)
    {
        return true;
    }
}

<?php

namespace App\Policies;

use App\User;
use App\Models\PostMeta;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostMetaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create PostMetas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function list(User $user)
    {
        return true;
    }


    /**
     * Determine whether the user can view the PostMeta.
     *
     * @param  \App\User  $user
     * @param  \App\Models\PostMeta  $postMeta
     * @return mixed
     */
    public function view(User $user, PostMeta $postMeta)
    {
        return true;
    }

    /**
     * Determine whether the user can create PostMetas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the PostMeta.
     *
     * @param  \App\User  $user
     * @param  \App\Models\PostMeta  $postMeta
     * @return mixed
     */
    public function update(User $user, PostMeta $postMeta)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the PostMeta.
     *
     * @param  \App\User  $user
     * @param  \App\Models\PostMeta  $postMeta
     * @return mixed
     */
    public function delete(User $user, PostMeta $postMeta)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the PostMeta.
     *
     * @param  \App\User  $user
     * @param  \App\Models\PostMeta  $postMeta
     * @return mixed
     */
    public function restore(User $user, PostMeta $postMeta)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the PostMeta.
     *
     * @param  \App\User  $user
     * @param  \App\Models\PostMeta  $postMeta
     * @return mixed
     */
    public function forceDelete(User $user, PostMeta $postMeta)
    {
        return true;
    }
}

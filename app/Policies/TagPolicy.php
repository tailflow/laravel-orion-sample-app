<?php

namespace App\Policies;

use App\Models\Tag;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create Tags.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function list(User $user)
    {
        return true;
    }


    /**
     * Determine whether the user can view the Tag.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Tag  $Tag
     * @return mixed
     */
    public function view(User $user, Tag $Tag)
    {
        return true;
    }

    /**
     * Determine whether the user can create Tags.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the Tag.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Tag  $Tag
     * @return mixed
     */
    public function update(User $user, Tag $Tag)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the Tag.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Tag  $Tag
     * @return mixed
     */
    public function delete(User $user, Tag $Tag)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the Tag.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Tag  $Tag
     * @return mixed
     */
    public function restore(User $user, Tag $Tag)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the Tag.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Tag  $Tag
     * @return mixed
     */
    public function forceDelete(User $user, Tag $Tag)
    {
        return true;
    }
}

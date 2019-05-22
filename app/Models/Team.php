<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function posts()
    {
        return $this->hasManyThrough(Post::class, User::class);
    }
}

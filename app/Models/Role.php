<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The roles that belong to the user.
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('meta');
    }
}

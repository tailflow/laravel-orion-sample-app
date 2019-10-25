<?php

namespace App\Http\Controllers\API;

use App\User;
use Orion\Http\Controllers\RelationController;

class UserRolesController extends RelationController
{
    /**
     * @var string|null $model
     */
    protected static $model = User::class;

    /**
     * @var string $relation
     */
    protected static $relation = 'roles';

    /**
     * The list of pivot fields that can be set upon relation resource creation or update.
     *
     * @var bool
     */
    protected $pivotFillable = ['meta'];

    /**
     * The list of pivot json fields that needs to be casted to array.
     *
     * @var array
     */
    protected $pivotJson = ['meta'];
}

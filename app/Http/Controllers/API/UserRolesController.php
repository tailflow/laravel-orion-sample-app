<?php

namespace App\Http\Controllers\API;

use App\User;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\RelationController;

class UserRolesController extends RelationController
{
    use DisableAuthorization;

    /**
     * @var string|null $model
     */
    protected $model = User::class;

    /**
     * @var string $relation
     */
    protected $relation = 'roles';

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

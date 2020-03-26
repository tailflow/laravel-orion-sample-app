<?php

namespace App\Http\Controllers\API;

use App\Models\Team;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\RelationController;

class TeamPostsController extends RelationController
{
    use DisableAuthorization;

    /**
     * @var string|null $model
     */
    protected $model = Team::class;

    /**
     * @var string $relation
     */
    protected $relation = 'posts';
}

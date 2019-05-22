<?php


namespace App\Http\Controllers\API;

use App\Models\Team;
use Laralord\Orion\Http\Controllers\RelationController;

class TeamPostsController extends RelationController
{
    /**
     * @var string|null $model
     */
    protected static $model = Team::class;

    /**
     * @var string $relation
     */
    protected static $relation = 'posts';
}
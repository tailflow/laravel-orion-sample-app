<?php


namespace App\Http\Controllers\API;

use App\User;
use Laralord\Orion\Http\Controllers\RelationController;

class UserPostsController extends RelationController
{
    /**
     * @var string|null $model
     */
    protected static $model = User::class;

    /**
     * @var string $relation
     */
    protected static $relation = 'posts';
}
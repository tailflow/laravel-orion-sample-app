<?php


namespace App\Http\Controllers\API;

use App\User;
use Orion\Http\Controllers\RelationController;

class UserPostsController extends RelationController
{
    /**
     * @var string|null $model
     */
    protected $model = User::class;

    /**
     * @var string $relation
     */
    protected $relation = 'posts';

    /**
     * @var string|null $relation
     */
    protected $associatingRelation = 'user';
}

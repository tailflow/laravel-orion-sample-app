<?php


namespace App\Http\Controllers\API;

use App\Models\Post;
use Orion\Http\Controllers\RelationController;

class PostUserController extends RelationController
{
    /**
     * @var string|null $model
     */
    protected $model = Post::class;

    /**
     * @var string $relation
     */
    protected $relation = 'user';
}

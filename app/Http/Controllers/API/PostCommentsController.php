<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Orion\Http\Controllers\RelationController;

class PostCommentsController extends RelationController
{
    /**
     * @var string|null $model
     */
    protected static $model = Post::class;

    /**
     * @var string $relation
     */
    protected static $relation = 'comments';
}

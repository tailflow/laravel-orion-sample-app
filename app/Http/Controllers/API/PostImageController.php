<?php

namespace App\Http\Controllers\API;


use App\Models\Post;
use Orion\Http\Controllers\RelationController;

class PostImageController extends RelationController
{
    /**
     * @var string|null $model
     */
    protected static $model = Post::class;

    /**
     * @var string $relation
     */
    protected static $relation = 'image';
}

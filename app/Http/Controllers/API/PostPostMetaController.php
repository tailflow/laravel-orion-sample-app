<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\PostMetaResource;
use App\Models\Post;
use Laralord\Orion\Http\Controllers\RelationController;

class PostPostMetaController extends RelationController
{
    /**
     * @var string|null $model
     */
    protected static $model = Post::class;

    /**
     * @var string $relation
     */
    protected static $relation = 'meta';

    /**
     * @var string $resource
     */
    protected static $resource = PostMetaResource::class;
}
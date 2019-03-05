<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\TagResource;
use App\Models\Post;
use Laralord\Orion\Http\Controllers\RelationController;

class PostTagsController extends RelationController
{
    /**
     * @var string|null $model
     */
    protected static $model = Post::class;

    /**
     * @var string $relation
     */
    protected static $relation = 'tags';

    /**
     * @var string $resource
     */
    protected static $resource = TagResource::class;
}
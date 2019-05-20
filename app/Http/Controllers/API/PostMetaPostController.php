<?php


namespace App\Http\Controllers\API;

use App\Http\Resources\PostResource;
use App\Models\PostMeta;
use Laralord\Orion\Http\Controllers\RelationController;

class PostMetaPostController extends RelationController
{
    /**
     * @var string|null $model
     */
    protected static $model = PostMeta::class;

    /**
     * @var string $relation
     */
    protected static $relation = 'post';

    /**
     * @var string $resource
     */
    protected static $resource = PostResource::class;
}
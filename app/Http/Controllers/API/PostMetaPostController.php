<?php


namespace App\Http\Controllers\API;

use App\Models\PostMeta;
use Orion\Http\Controllers\RelationController;

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
}

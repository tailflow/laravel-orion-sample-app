<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\RelationController;

class PostTagsController extends RelationController
{
    use DisableAuthorization;

    /**
     * @var string|null $model
     */
    protected static $model = Post::class;

    /**
     * @var string $relation
     */
    protected static $relation = 'tags';

    /**
     * The list of pivot fields that can be set upon relation resource creation or update.
     *
     * @var bool
     */
    protected $pivotFillable = ['meta'];
}

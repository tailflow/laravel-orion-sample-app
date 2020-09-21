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
    protected $model = Post::class;

    /**
     * @var string $relation
     */
    protected $relation = 'tags';

    /**
     * The list of pivot fields that can be set upon relation resource creation or update.
     *
     * @var bool
     */
    protected $pivotFillable = ['meta'];

    protected function filterableBy() : array
    {
        return ['name'];
    }
}

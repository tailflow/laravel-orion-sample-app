<?php


namespace App\Http\Controllers\API;

use App\Models\Tag;

class TagPostsController extends APIController
{
    /**
     * @var string|null $model
     */
    protected $model = Tag::class;

    /**
     * @var string $relation
     */
    protected $relation = 'posts';
}

<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\RelationController;

class PostCommentsController extends RelationController
{
    use DisableAuthorization;

    /**
     * @var string|null $model
     */
    protected $model = Post::class;

    /**
     * @var string $relation
     */
    protected $relation = 'comments';

    protected function sortableBy() : array
    {
        return ['body', 'commentable.title'];
    }

    protected function includes() : array
    {
        return ['commentable'];
    }
}

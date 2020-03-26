<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\RelationController;

class PostImageController extends RelationController
{
    use DisableAuthorization;

    /**
     * @var string|null $model
     */
    protected $model = Post::class;

    /**
     * @var string $relation
     */
    protected $relation = 'image';
}

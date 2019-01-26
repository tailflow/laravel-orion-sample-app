<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Laralord\Orion\Http\Controllers\Controller;
use Laralord\Orion\Traits\DisableAuthorization;

class PostsController extends Controller
{
    use DisableAuthorization;

    /**
     * @var string|null $model
     */
    protected static $model = Post::class;

    /**
     * @var string $resource
     */
    protected static $resource = PostResource::class;
}

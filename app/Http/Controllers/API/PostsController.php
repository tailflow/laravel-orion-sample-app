<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\User;
use Illuminate\Http\Request;
use Laralord\Orion\Traits\DisableAuthorization;

class PostsController extends APIController
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

    /**
     * @param Request $request
     * @param Post $entity
     * @return mixed|void
     */
    protected function beforeSave(Request $request, $entity)
    {
        $entity->user()->associate(User::query()->find(1));
    }
}

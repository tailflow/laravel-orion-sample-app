<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use App\User;
use Laralord\Orion\Http\Requests\Request;
use Laralord\Orion\Concerns\DisableAuthorization;

class PostsController extends APIController
{
    use DisableAuthorization;
    /**
     * @var string|null $model
     */
    protected static $model = Post::class;

    /**
     * @param Request $request
     * @param Post $entity
     * @return mixed|void
     */
    protected function beforeSave(Request $request, $entity)
    {
        $entity->user()->associate(User::query()->find(1));
    }

    protected function sortableBy()
    {
        return ['title'];
    }

    protected function filterableBy()
    {
        return ['title'];
    }

    protected function searchableBy()
    {
        return ['title'];
    }

    /**
     * @return array
     */
    protected function includes()
    {
        return ['user', 'image', 'comments', 'tags'];
    }
}

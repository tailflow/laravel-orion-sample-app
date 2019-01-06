<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Laravel\Orion\Controllers\Controller;

class PostsController extends Controller
{
    /**
     * @return string
     */
    protected function forModel()
    {
        return Post::class;
    }
}

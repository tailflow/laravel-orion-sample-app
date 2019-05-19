<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laralord\Orion\Orion;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['as' => 'api.'], function() {
    Orion::resource('posts', 'API\PostsController');
    Orion::hasOneResource('posts', 'meta', 'API\PostPostMetaController');
    Orion::morphOneResource('posts', 'image', 'API\PostImageController');
    Orion::morphManyResource('posts', 'comments', 'API\PostCommentsController');
    Orion::morphToManyResource('posts', 'tags', 'API\PostTagsController');

    Orion::resource('roles', 'API\RolesController');

    Orion::belongsToManyResource('users', 'roles', 'API\UserRolesController');
    Orion::hasManyResource('users', 'posts', 'API\UserPostsController');
});


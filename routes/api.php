<?php

use Illuminate\Http\Request;

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
    \Laralord\Orion\Orion::resource('posts', 'API\PostsController');
    \Laralord\Orion\Orion::resourceRelation('posts', 'meta', 'API\PostPostMetaController');
    \Laralord\Orion\Orion::resourceRelation('posts', 'image', 'API\PostImageController');
    \Laralord\Orion\Orion::resourceRelation('posts', 'comments', 'API\PostCommentsController');
    \Laralord\Orion\Orion::resourceRelation('posts', 'tags', 'API\PostTagsController');

    \Laralord\Orion\Orion::resource('roles', 'API\RolesController');

    \Laralord\Orion\Orion::resourceRelation('users', 'roles', 'API\UserRolesController');
});


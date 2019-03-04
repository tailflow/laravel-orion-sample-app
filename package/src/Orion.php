<?php


namespace Laralord\Orion;


class Orion
{
    public static function resource($name, $controller, $options = [])
    {
        \Illuminate\Support\Facades\Route::apiResource($name, $controller, $options);
    }

    public static function resourceRelation($resource, $relation, $controller)
    {
        $resourceName = str_singular($resource);

        \Illuminate\Support\Facades\Route::get("{$resource}/{{$resourceName}}/{$relation}/{{$relation}}", $controller. '@show')->name("$resource.relation.$relation.show");
    }
}

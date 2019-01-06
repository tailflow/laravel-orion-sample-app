<?php


namespace Laravel\Orion;

class Orion
{
    public static function resource($name, $controller, $options = [])
    {

    }

    public function defineCRUDRoutes($name, $controller, $options)
    {
        \Illuminate\Support\Facades\Route::apiResource($name, $controller, $options);
    }

    public function defineRelationsRoutes($name, $controller, $options)
    {

    }
}

<?php


namespace Laralord\Orion;

class Orion
{
    public static function resource($name, $controller, $options = [])
    {
        static::crud($name, $controller, $options);
        static::relations($name, $controller, $options);
    }

    public static function crud($name, $controller, $options)
    {
        \Illuminate\Support\Facades\Route::apiResource($name, $controller, $options);
    }

    public static function relations($name, $controller, $options)
    {

    }
}

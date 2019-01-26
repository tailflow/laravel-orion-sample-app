<?php

namespace Laralord\Orion\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Resources\Json\JsonResource;
use Laralord\Orion\Traits\HandlesCRUDOperations;
use Laralord\Orion\Traits\HandlesRelationOperations;

class Controller extends \Illuminate\Routing\Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,
        HandlesCRUDOperations, HandlesRelationOperations;

    /**
     * @var string|null $model
     */
    protected static $model = null;

    /**
     * @var string $resource
     */
    protected static $resource = JsonResource::class;

    /**
     * Controller constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        if (!static::$model) throw new \Exception('Model is not specified for '.__CLASS__.' controller.');
        if (!property_exists($this, 'authorizationDisabled'))
            $this->authorizeResource(static::$model);
    }


    /**
     * @return array
     */
    protected function sortable()
    {
        return [];
    }

    /**
     * @return array
     */
    protected function filterable()
    {
        return [];
    }

    /**
     * @return array
     */
    protected function relations()
    {
        return [];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function buildBaseQuery()
    {
        return with(new static::$model)->query();
    }
}

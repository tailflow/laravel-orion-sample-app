<?php

namespace Laravel\Orion\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Resources\Json\Resource;
use Laravel\Orion\Traits\HandlesCRUDOperations;
use Laravel\Orion\Traits\HandlesRelationOperations;

abstract class Controller extends \Illuminate\Routing\Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,
        HandlesCRUDOperations, HandlesRelationOperations;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        if (!property_exists($this, 'authorizationDisabled'))
            $this->authorizeResource($this->forModel());
    }

    /**
     * @return string
     */
    abstract protected function forModel();

    /**
     * @return string
     */
    protected function useResource()
    {
        return Resource::class;
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
        return with($this->forModel())->query();
    }
}

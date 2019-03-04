<?php

namespace Laralord\Orion\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Laralord\Orion\Traits\BuildsQuery;

class BaseController extends \Illuminate\Routing\Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, BuildsQuery;

    /**
     * @var string|null $model
     */
    protected static $model = null;

    /**
     * @var string $resource
     */
    protected static $resource = JsonResource::class;

    /**
     * @var string $collectionResource
     */
    protected static $collectionResource = null;

    /**
     * Controller constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        if (!static::$model) throw new \Exception('Model is not specified for ' . __CLASS__ . ' controller.');
    }

    /**
     * @return array
     */
    protected function sortableBy()
    {
        return [];
    }

    /**
     * @return array
     */
    protected function filterableBy()
    {
        return [];
    }

    /**
     * @return array
     */
    protected function searchableBy()
    {
        return [];
    }

    /**
     * @return array
     */
    protected function includes()
    {
        return [];
    }

    /**
     * @return array
     */
    protected function alwaysIncludes()
    {
        return [];
    }

    protected function authorizationRequired()
    {
        return property_exists($this, 'authorizationDisabled');
    }

    protected function hookResponds($hookResult)
    {
        return $hookResult instanceof Response;
    }

    /**
     * Get the map of resource methods to ability names.
     *
     * @return array
     */
    protected function resourceAbilityMap()
    {
        return [
            'index' => 'list',
            'show' => 'view',
            'create' => 'create',
            'store' => 'create',
            'edit' => 'update',
            'update' => 'update',
            'destroy' => 'delete',
        ];
    }
}
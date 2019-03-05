<?php

namespace Laralord\Orion\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Resources\Json\ResourceCollection;

trait HandlesRelationOperations
{
    /**
     * Fetch the list of relation resources.
     *
     * @param Request $request
     * @param int $resourceID
     * @return ResourceCollection
     */
    public function index(Request $request, $resourceID)
    {
        $beforeHookResult = $this->beforeIndex($request);
        if ($this->hookResponds($beforeHookResult)) return $beforeHookResult;

        if ($this->authorizationRequired()) $this->authorize('index', static::$model);

        $resourceEntity = $this->buildMethodQuery($request)->with($this->relationsFromIncludes($request))->findOrFail($resourceID);
        $entities = $this->buildRelationMethodQuery($request, $resourceEntity)->with($this->relationsFromIncludes($request))->paginate();

        $afterHookResult = $this->afterIndex($request, $entities);
        if ($this->hookResponds($afterHookResult)) return $afterHookResult;

        return static::$collectionResource ? new static::$collectionResource($entities) : static::$resource::collection($entities);
    }

    /**
     * Create new relation resource.
     *
     * @param Request $request
     * @param int $resourceID
     * @return Resource
     */
    public function store(Request $request, $resourceID)
    {
        $beforeHookResult = $this->beforeStore($request);
        if ($this->hookResponds($beforeHookResult)) return $beforeHookResult;

        $relationModelClass = $this->getRelationModelClass();

        if ($this->authorizationRequired()) $this->authorize('store', $relationModelClass);

        /**
         * @var Model $entity
         */
        $resourceEntity = $this->buildMethodQuery($request)->with($this->relationsFromIncludes($request))->findOrFail($resourceID);

        $entity = new $relationModelClass();
        $entity->fill($request->only($entity->getFillable()));

        $beforeSaveHookResult = $this->beforeSave($request, $entity);
        if ($this->hookResponds($beforeSaveHookResult)) return $beforeSaveHookResult;

        $resourceEntity->{static::$relation}()->save($entity);

        $entity->load($this->relationsFromIncludes($request));

        $afterSaveHookResult = $this->afterSave($request, $entity);
        if ($this->hookResponds($afterSaveHookResult)) return $afterSaveHookResult;

        $afterHookResult = $this->afterStore($request, $entity);
        if ($this->hookResponds($afterHookResult)) return $afterHookResult;

        return new static::$resource($entity);
    }

    /**
     * Fetch a relation resource.
     *
     * @param Request $request
     * @param int $resourceID
     * @param int $relationID
     * @return Resource
     */
    public function show(Request $request, $resourceID, $relationID)
    {
        $beforeHookResult = $this->beforeShow($request, $relationID);
        if ($this->hookResponds($beforeHookResult)) return $beforeHookResult;

        $resourceEntity = $this->buildMethodQuery($request)->with($this->relationsFromIncludes($request))->findOrFail($resourceID);
        $entity = $this->buildRelationMethodQuery($request, $resourceEntity)->with($this->relationsFromIncludes($request))->findOrFail($relationID);

        if ($this->authorizationRequired()) $this->authorize('show', $entity);

        $afterHookResult = $this->afterShow($request, $entity);
        if ($this->hookResponds($afterHookResult)) return $afterHookResult;

        return new static::$resource($entity);
    }

    /**
     * Update a relation resource.
     *
     * @param Request $request
     * @param int $resourceID
     * @param int $relationID
     * @return Resource
     */
    public function update(Request $request, $resourceID, $relationID)
    {
        $beforeHookResult = $this->beforeUpdate($request, $relationID);
        if ($this->hookResponds($beforeHookResult)) return $beforeHookResult;

        $resourceEntity = $this->buildMethodQuery($request)->with($this->relationsFromIncludes($request))->findOrFail($resourceID);
        $entity = $this->buildRelationMethodQuery($request, $resourceEntity)->with($this->relationsFromIncludes($request))->findOrFail($relationID);

        if ($this->authorizationRequired()) $this->authorize('update', $entity);

        $entity->fill($request->only($entity->getFillable()));

        $beforeSaveHookResult = $this->beforeSave($request, $entity);
        if ($this->hookResponds($beforeSaveHookResult)) return $beforeSaveHookResult;

        $entity->save();

        $entity->load($this->relationsFromIncludes($request));

        $afterSaveHookResult = $this->afterSave($request, $entity);
        if ($this->hookResponds($afterSaveHookResult)) return $afterSaveHookResult;

        $afterHookResult = $this->afterUpdate($request, $entity);
        if ($this->hookResponds($afterHookResult)) return $afterHookResult;

        return new static::$resource($entity);
    }

    /**
     * Delete a relation resource.
     *
     * @param Request $request
     * @param int $resourceID
     * @param int $relationID
     * @return Resource
     * @throws \Exception
     */
    public function destroy(Request $request, $resourceID, $relationID)
    {
        $beforeHookResult = $this->beforeDestroy($request, $relationID);
        if ($this->hookResponds($beforeHookResult)) return $beforeHookResult;

        $resourceEntity = $this->buildMethodQuery($request)->with($this->relationsFromIncludes($request))->findOrFail($resourceID);
        $entity = $this->buildRelationMethodQuery($request, $resourceEntity)->with($this->relationsFromIncludes($request))->findOrFail($relationID);

        if ($this->authorizationRequired()) $this->authorize('destroy', $entity);

        $entity->delete();

        $afterHookResult = $this->afterDestroy($request, $entity);
        if ($this->hookResponds($afterHookResult)) return $afterHookResult;

        return new static::$resource($entity);
    }

    /**
     * The hooks is executed before fetching the list of relation resources.
     *
     * @param Request $request
     * @return mixed
     */
    protected function beforeIndex(Request $request)
    {
        return null;
    }

    /**
     * The hooks is executed after fetching the list of relation resources.
     *
     * @param Request $request
     * @param LengthAwarePaginator $entities
     * @return mixed
     */
    protected function afterIndex(Request $request, LengthAwarePaginator $entities)
    {
        return null;
    }

    /**
     * The hook is executed before creating new relation resource.
     *
     * @param Request $request
     * @return mixed
     */
    protected function beforeStore(Request $request)
    {
        return null;
    }

    /**
     * The hook is executed after creating new relation resource.
     *
     * @param Request $request
     * @param Model $entity
     * @return mixed
     */
    protected function afterStore(Request $request, $entity)
    {
        return null;
    }

    /**
     * The hook is executed before fetching relation resource.
     *
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    protected function beforeShow(Request $request, int $id)
    {
        return null;
    }

    /**
     * The hook is executed after fetching a relation resource
     *
     * @param Request $request
     * @param Model $entity
     * @return mixed
     */
    protected function afterShow(Request $request, $entity)
    {
        return null;
    }

    /**
     * The hook is executed before updating a relation resource.
     *
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    protected function beforeUpdate(Request $request, int $id)
    {
        return null;
    }

    /**
     * The hook is executed after updating a relation resource.
     *
     * @param Request $request
     * @param Model $entity
     * @return mixed
     */
    protected function afterUpdate(Request $request, $entity)
    {
        return null;
    }

    /**
     * The hook is executed before deleting a relation resource.
     *
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    protected function beforeDestroy(Request $request, int $id)
    {
        return null;
    }

    /**
     * The hook is executed after deleting a relation resource.
     *
     * @param Request $request
     * @param Model $entity
     * @return mixed
     */
    protected function afterDestroy(Request $request, $entity)
    {
        return null;
    }

    /**
     * The hook is executed before creating or updating a relation resource.
     *
     * @param Request $request
     * @param Model $entity
     * @return mixed
     */
    protected function beforeSave(Request $request, $entity)
    {
        return null;
    }

    /**
     * The hook is executed after creating or updating a relation resource.
     *
     * @param Request $request
     * @param Model $entity
     * @return mixed
     */
    protected function afterSave(Request $request, $entity)
    {
        return null;
    }

    /**
     * Get Eloquent query builder for the relation model and apply filters, searching and sorting.
     *
     * @param Request $request
     * @param Model $resourceEntity
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function buildRelationQuery(Request $request, $resourceEntity)
    {
        /**
         * @var Builder $query
         */
        $query = $resourceEntity->{static::$relation}()->getQuery();

        // only for index method (well, and show method also, but it does not make sense to sort, filter or search data in the show method via query parameters...)
        if ($request->isMethod('GET')) {
            $this->applyFiltersToQuery($request, $query);
            $this->applySearchingToQuery($request, $query);
            $this->applySortingToQuery($request, $query);
        }

        return $query;
    }

    /**
     * Get custom query builder, if any, otherwise use default; apply filters, searching and sorting.
     *
     * @param Request $request
     * @param Model $resourceEntity
     * @return Builder
     */
    protected function buildRelationMethodQuery(Request $request, $resourceEntity)
    {
        $method = debug_backtrace()[1]['function'];
        $customQueryMethod = 'buildRelation' . ucfirst($method) . 'Query';

        if (method_exists($this, $customQueryMethod)) return $this->{$customQueryMethod}($request);
        return $this->buildRelationQuery($request, $resourceEntity);
    }

    /**
     * Get relation model class from the relation.
     *
     * @return string
     */
    protected function getRelationModelClass()
    {
        return get_class(with(new static::$model)->{static::$relation}()->getModel());
    }
}

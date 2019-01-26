<?php

namespace Laralord\Orion\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

trait HandlesCRUDOperations
{
    public function index(Request $request)
    {
        $beforeHookResult = $this->beforeIndex($request);
        if ($this->hookResponds($beforeHookResult)) return $beforeHookResult;

        $entities = $this->buildMethodQuery($request)->with($this->relationsFromIncludes($request))->paginate();

        $afterHookResult = $this->afterIndex($request, $entities);
        if ($this->hookResponds($afterHookResult)) return $afterHookResult;

        return static::$resource::collection($entities);
    }

    public function store(Request $request)
    {
        $beforeHookResult = $this->beforeStore($request);
        if ($this->hookResponds($beforeHookResult)) return $beforeHookResult;

        /**
         * @var Model $entity
         */
        $entity = new static::$model;
        $entity->fill($request->only($entity->getFillable()));

        $beforeSaveHookResult = $this->beforeSave($request, $entity);
        if ($this->hookResponds($beforeSaveHookResult)) return $beforeSaveHookResult;

        $entity->save();

        $entity->load($this->relationsFromIncludes($request));

        $afterSaveHookResult = $this->afterSave($request, $entity);
        if ($this->hookResponds($afterSaveHookResult)) return $afterSaveHookResult;

        $afterHookResult = $this->afterStore($request, $entity);
        if ($this->hookResponds($afterHookResult)) return $afterHookResult;

        return new static::$resource($entity);
    }

    public function show(Request $request, $id)
    {
        $beforeHookResult = $this->beforeShow($request, $id);
        if ($this->hookResponds($beforeHookResult)) return $beforeHookResult;

        $entity = $this->buildMethodQuery($request)->with($this->relationsFromIncludes($request))->findOrFail($id);

        $afterHookResult = $this->afterShow($request, $entity);
        if ($this->hookResponds($afterHookResult)) return $afterHookResult;

        return new static::$resource($entity);
    }

    public function update(Request $request, $id)
    {
        $beforeHookResult = $this->beforeUpdate($request, $id);
        if ($this->hookResponds($beforeHookResult)) return $beforeHookResult;

        $entity = $this->buildMethodQuery($request)->with($this->relationsFromIncludes($request))->findOrFail($id);
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

    public function destroy(Request $request, $id)
    {
        $beforeHookResult = $this->beforeDestroy($request, $id);
        if ($this->hookResponds($beforeHookResult)) return $beforeHookResult;

        $entity = $this->buildMethodQuery($request)->with($this->relationsFromIncludes($request))->findOrFail($id);
        $entity->delete();

        $afterHookResult = $this->afterDestroy($request, $entity);
        if ($this->hookResponds($afterHookResult)) return $afterHookResult;

        return new static::$resource($entity);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    protected function beforeIndex(Request $request)
    {
        return null;
    }

    /**
     * @param Request $request
     * @param LengthAwarePaginator $entities
     * @return mixed
     */
    protected function afterIndex(Request $request, LengthAwarePaginator $entities)
    {
        return null;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    protected function beforeStore(Request $request)
    {
        return null;
    }

    /**
     * @param Request $request
     * @param Model $entity
     * @return mixed
     */
    protected function afterStore(Request $request, $entity)
    {
        return null;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    protected function beforeShow(Request $request, int $id)
    {
        return null;
    }

    /**
     * @param Request $request
     * @param Model $entity
     * @return mixed
     */
    protected function afterShow(Request $request, $entity)
    {
        return null;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    protected function beforeUpdate(Request $request, int $id)
    {
        return null;
    }

    /**
     * @param Request $request
     * @param Model $entity
     * @return mixed
     */
    protected function afterUpdate(Request $request, $entity)
    {
        return null;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    protected function beforeDestroy(Request $request, int $id)
    {
        return null;
    }

    /**
     * @param Request $request
     * @param Model $entity
     * @return mixed
     */
    protected function afterDestroy(Request $request, $entity)
    {
        return null;
    }

    /**
     * @param Request $request
     * @param Model $entity
     * @return mixed
     */
    protected function beforeSave(Request $request, $entity)
    {
        return null;
    }

    /**
     * @param Request $request
     * @param Model $entity
     * @return mixed
     */
    protected function afterSave(Request $request, $entity)
    {
        return null;
    }

    protected function hookResponds($hookResult)
    {
        return $hookResult instanceof Response;
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function relationsFromIncludes(Request $request)
    {
        $requestedIncludesStr = $request->get('include', '');
        $requestedIncludes = explode(',', $requestedIncludesStr);

        $allowedIncludes = array_unique(array_merge($this->includes(), $this->alwaysIncludes()));

        $validatedIncludes = array_filter($requestedIncludes, function ($include) use ($allowedIncludes) {
            return in_array($include, $allowedIncludes, true);
        });

        return array_unique(array_merge($validatedIncludes, $this->alwaysIncludes()));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function buildQuery(Request $request)
    {
        return static::$model::query();
    }

    /**
     * @param Request $request
     * @return Builder
     */
    protected function buildMethodQuery(Request $request)
    {
        $method = debug_backtrace()[1]['function'];
        $customQueryMethod = 'build' . ucfirst($method) . 'Query';

        if (method_exists($this, $customQueryMethod)) return $this->{$customQueryMethod}($request);
        return $this->buildQuery($request);
    }
}

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
        /**
         * @var Builder $query
         */
        $query = static::$model::query();

        // only for index method (well, and show method also, but it does not make sense to sort or filter data in the show method via query parameters...)
        if ($request->isMethod('GET')) {
            $this->applyFiltersToQuery($request, $query);
            $this->applySortingToQuery($request, $query);
        }

        return $query;
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

    protected function applySortingToQuery(Request $request, Builder $query)
    {
        if (!$requestedSortableDescriptorsStr = $request->get('sort')) return;

        $requestedSortableDescriptors = explode(',', $requestedSortableDescriptorsStr);
        $allowedSortables = $this->sortableBy();

        $validatedSortableDescriptors = array_filter($requestedSortableDescriptors, function ($sortableDescriptor) use ($allowedSortables) {
            $sortableDescriptorParams = array_filter(explode('|', $sortableDescriptor));
            if (count($sortableDescriptorParams) !== 2) return false;

            [$sortable, $direction] = $sortableDescriptorParams;

            return in_array($direction, ['asc', 'desc'], true) && $this->validParamConstraint($sortable, $allowedSortables);
        });

        foreach ($validatedSortableDescriptors as $sortableDescriptor) {
            [$sortable, $direction] = explode('|', $sortableDescriptor);
            $query->orderBy($sortable, $direction);
        }
    }

    protected function applyFiltersToQuery(Request $request, Builder $query)
    {
        $requestedFilterables = $request->query();
        $allowedFilterables = $this->filterableBy();

        $validatedFilterables = array_filter($requestedFilterables, function ($filterable) use ($allowedFilterables) {
            return $this->validParamConstraint($filterable, $allowedFilterables);
        }, ARRAY_FILTER_USE_KEY);

        foreach ($validatedFilterables as $filterable => $filterValue) {
            if (strpos($filterable, '.') !== false) {
                $relation = implode('.', array_slice(explode('.', $filterable), -1));
                $relationField = array_last(explode('.', $filterable));
                $query->whereHas($relation, function ($relationQuery) use ($relationField, $filterValue) {
                    /**
                     * @var \Illuminate\Database\Query\Builder $relationQuery
                     */
                    return $relationQuery->where($relationField, $filterValue);
                });
            } else {
                $query->where($filterable, $filterValue);
            }
        }
    }

    /**
     * @param string $paramConstraint
     * @param array $allowedParamConstraints
     * @return bool
     */
    protected function validParamConstraint(string $paramConstraint, array $allowedParamConstraints)
    {
        if (in_array('*', $allowedParamConstraints, true)) return true;
        if (in_array($paramConstraint, $allowedParamConstraints, true)) return true;

        if (strpos($paramConstraint, '.') === false) return false;

        $allowedNestedParamConstraints = array_filter($allowedParamConstraints, function ($allowedParamConstraint) {
            return strpos($allowedParamConstraint, '.*') !== false;
        });

        $paramConstraintNestingLevel = substr_count($paramConstraint, '.');

        foreach ($allowedNestedParamConstraints as $allowedNestedParamConstraint) {
            $allowedNestedParamConstraintNestingLevel = substr_count($allowedNestedParamConstraint, '.');
            $allowedNestedParamConstraintReduced = explode('.*', $allowedNestedParamConstraint)[0];

            for ($i = 0; $i < $allowedNestedParamConstraintNestingLevel; $i++) {
                $allowedNestedParamConstraintReduced = implode('.', array_slice(explode('.', $allowedNestedParamConstraintReduced), -$i));

                $paramConstraintReduced = $paramConstraint;
                for ($k = 1; $k < $paramConstraintNestingLevel; $k++) {
                    $paramConstraintReduced = implode('.', array_slice(explode('.', $paramConstraintReduced), -$i));
                    if ($paramConstraintReduced === $allowedNestedParamConstraintReduced) return true;
                }
            }
        }

        return false;
    }
}

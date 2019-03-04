<?php

namespace Laralord\Orion\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait BuildsQuery
{
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

        // only for index method (well, and show method also, but it does not make sense to sort, filter or search data in the show method via query parameters...)
        if ($request->isMethod('GET')) {
            $this->applyFiltersToQuery($request, $query);
            $this->applySearchingToQuery($request, $query);
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

    protected function applySearchingToQuery(Request $request, Builder $query)
    {
        if (!$requestedSearchStr = $request->get('q')) return;

        $searchables = $this->searchableBy();
        if (!count($searchables)) return;

        $query->where(function($whereQuery) use ($searchables, $requestedSearchStr) {
            /**
             * @var Builder $whereQuery
             */
            foreach ($searchables as $searchable) {
                if (strpos($searchable, '.') !== false) {
                    $relation = implode('.', array_slice(explode('.', $searchable), -1));
                    $relationField = array_last(explode('.', $searchable));
                    $whereQuery->orWhereHas($relation, function ($relationQuery) use ($relationField, $requestedSearchStr) {
                        /**
                         * @var \Illuminate\Database\Query\Builder $relationQuery
                         */
                        return $relationQuery->where($relationField, 'like', '%'.$requestedSearchStr.'%');
                    });
                } else {
                    $whereQuery->orWhere($searchable, 'like', '%'.$requestedSearchStr.'%');
                }
            }
        });
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

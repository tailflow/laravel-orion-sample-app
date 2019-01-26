<?php

namespace Laralord\Orion\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait HandlesCRUDOperations
{
    public function index(Request $request)
    {
        $entities = $this->buildBaseQuery()->paginate();

        return static::$resource::collection($entities);
    }

    public function store(Request $request)
    {
        /**
         * @var Model $entity
         */
        $entity = new static::$model;
        $entity->fill($request->only($entity->getFillable()));
        $entity->save();

        return new static::$resource($entity);
    }

    public function show(Request $request, $id)
    {
        $entity = $this->buildBaseQuery()->findOrFail($id);

        return new static::$resource($entity);
    }

    public function update(Request $request, $id)
    {
        $entity = $this->buildBaseQuery()->findOrFail($id);
        $entity->fill($request->only($entity->getFillable()));
        $entity->save();

        return new static::$resource($entity);
    }

    public function destroy(Request $request, $id)
    {
        $entity = $this->buildBaseQuery()->findOrFail($id);
        $entity->delete();

        return new static::$resource($entity);
    }
}

<?php

namespace Laravel\Orion\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait HandlesCRUDOperations
{
    public function index(Request $request)
    {
        $entities = $this->buildBaseQuery()->paginate();

        return $this->useResource()::collection($entities);
    }

    public function store(Request $request)
    {
        /**
         * @var Model $entity
         */
        $entity = new $this->forModel();
        $entity->fill($request->only($entity->getFillable()));
        $entity->save();

        return new $this->useResource()($entity);
    }

    public function show(Request $request, $id)
    {
        $entity = $this->buildBaseQuery()->findOrFail($id);

        return new $this->useResource()($entity);
    }

    public function update(Request $request, $id)
    {
        $entity = $this->buildBaseQuery()->findOrFail($id);
        $entity->fill($request->only($entity->getFillable()));
        $entity->save();

        return new $this->useResource()($entity);
    }

    public function destroy(Request $request, $id)
    {
        $this->buildBaseQuery()->destroy($id);

        return response()->json(['deleted' => true]);
    }
}

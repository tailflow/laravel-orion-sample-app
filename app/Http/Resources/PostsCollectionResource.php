<?php

namespace App\Http\Resources;


use Orion\Http\Resources\ResourceCollection;

class PostsCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->toArrayWithMerge($request, [
            'field' => 'new val'
        ]);
    }
}

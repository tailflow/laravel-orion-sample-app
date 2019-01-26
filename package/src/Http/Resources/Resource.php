<?php

namespace Laralord\Orion\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Resource extends JsonResource
{
    /**
     * Merges transformed resource with the given data.
     *
     * @param Request $request
     * @param array $mergeData
     * @return array
     */
    protected function toArrayWithMerge($request, $mergeData)
    {
        return array_merge(parent::toArray($request), $mergeData);
    }
}

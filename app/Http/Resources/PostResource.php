<?php

namespace App\Http\Resources;

use Laralord\Orion\Http\Resources\Resource;

class PostResource extends Resource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->toArrayWithMerge($request, [
            'field' => 'value',
            'user' => $this->whenLoaded('user')
        ]);
    }
}

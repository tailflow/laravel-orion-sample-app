<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;

class PostRequest extends Request
{
    public function commonRules() : array
    {
        return [
            'title' => 'required'
        ];
    }

    public function storeRules() : array
    {
        return [
            //'status' => 'required|in:draft,review'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;

class PostRequest extends Request
{
    public function commonRules()
    {
        return [
            'title' => 'required'
        ];
    }

    public function storeRules()
    {
        return [
            'status' => 'required|in:draft,review'
        ];
    }
}

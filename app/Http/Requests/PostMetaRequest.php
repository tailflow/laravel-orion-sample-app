<?php


namespace App\Http\Requests;


use Laralord\Orion\Http\Requests\Request;

class PostMetaRequest extends Request
{
    public function authorize()
    {
        return true;
    }
}

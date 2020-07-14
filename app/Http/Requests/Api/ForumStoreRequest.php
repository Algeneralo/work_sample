<?php

namespace App\Http\Requests\Api;

use App\Models\Forum;
use Illuminate\Foundation\Http\FormRequest;

class ForumStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'designation' => 'required',
            'details' => 'required',
            'image' => 'sometimes|image',
        ];
    }

    protected function prepareForValidation()
    {
        //set default value for posts_type
        $this->merge(["posts_type"=> Forum::POST_TYPES_ALL_USERS]);
    }
}
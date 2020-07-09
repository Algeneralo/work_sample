<?php

namespace App\Http\Requests\Admin;

use App\Models\Forum;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ForumStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'designation' => 'required',
            'details' => 'required',
            'image' => 'image',
            'posts_type' => ["required", Rule::in(Forum::POST_TYPES_ALL_USERS, Forum::POST_TYPES_ADMINS)],
        ];
    }
}

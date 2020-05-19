<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class JobMarketUpdateRequest extends FormRequest
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
            'employer' => 'required|max:80',
            'offer' => 'required|max:80',
            'category' => 'required',
            'working_hours' => 'required|in:full_time,part_time',
            'beginning' => 'required',
            'details' => 'required',
            'image' => 'image',
            'duration' => 'required',
            'city' => 'required',
        ];
    }
}

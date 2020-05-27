<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class JobMarketStoreRequest extends FormRequest
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
            'image' => 'required|image',
            'duration' => 'required',
            'city' => 'required',
            "link" => "required|url",
            "contact_name" => "required",
            "company_name" => "required",
            "email" => "required|email",
            "telephone" => "required",
        ];
    }
}

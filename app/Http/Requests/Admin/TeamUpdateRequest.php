<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TeamUpdateRequest extends FormRequest
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
            'first_name' => 'required|max:40',
            'last_name' => 'required|max:40',
            'gender' => 'required|in:m,f',
            'street' => 'required|max:80',
            'street_number' => 'required|max:40',
            'postcode' => 'required|max:40',
            'city' => 'required|max:40',
            'email' => 'required|email|unique:alumni,id,' . $this->team->id,
            'dob' => 'required',
            'telephone' => 'required|max:50',
            'mobile' => 'required|max:50',
            "image" => "image"
        ];
    }
}

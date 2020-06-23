<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class EventStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            "image" => "required|image",
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'street' => 'required',
            'street_number' => 'required',
            'postcode' => 'required',
            'city' => 'required',
            'details' => 'required',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EventUpdateRequest extends FormRequest
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
            'name' => 'required',
            'date' => 'required',
            'time' => 'required',
            'street' => 'required',
            'street_number' => 'required',
            'postcode' => 'required',
            'city' => 'required',
            'details' => 'required',
            'participants' => 'required|array',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    protected function prepareForValidation()
    {
        try {
            $this->merge([
                "participants" => json_decode($this->participants)
            ]);
        } catch (\Exception $exception) {
            \Log::error("Invalid participants array");
        }
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => ['required', 'min:3', 'max:255'],
            'price' => ['required', 'gt:0'],
            'description' => ['required', 'min:15'],
            'brand_id' => ['required', 'gt:0', 'exists:brands,id'],
            'country_id' => ['required', 'gt:0', 'exists:countries,id'],
            'type_id' => ['required', 'gt:0', 'exists:types,id']
        ];
    }
}

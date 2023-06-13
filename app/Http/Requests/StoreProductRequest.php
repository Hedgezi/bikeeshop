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
            'description' => ['required', 'min:15'],
            'brand_id' => ['required', 'gt:0', 'exists:brands,id'],
            'country_id' => ['required', 'gt:0', 'exists:countries,id'],
            'type_id' => ['required', 'gt:0', 'exists:types,id'],
            'variants' => ['array'],
            'variants.*.price' => ['required', 'gt:0'],
            'variants.*.quantity' => ['required', 'gt:0'],
            'variants.*.attribute_id.*' => ['required', 'exists:attributes,id', 'distinct'],
            'variants.*.attribute_value.*' => ['required'],
            'image.*' => ['image', 'mimes:jpeg,png,jpg,webp'],
        ];
    }
}

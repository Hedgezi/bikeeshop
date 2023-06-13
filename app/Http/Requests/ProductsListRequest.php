<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductsListRequest extends FormRequest
{

    private const PER_PAGE = 50;

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
            'page' => ['nullable', 'gt:0']
        ];
    }

    public function getPage(): int
    {
        return (int) $this->get('page', 1);
    }

    public function getPerPage(): int
    {
        return self::PER_PAGE;
    }
}

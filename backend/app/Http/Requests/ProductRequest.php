<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:products,product_code',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'promotion_price' => 'nullable|numeric|min:0|lte:price',
            'include_vat' => 'boolean',
            'evaluate' => 'nullable|numeric|min:0|max:5',
            'color' => 'nullable|string|max:255',
            'material' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:0',
            'warranty' => 'nullable|string|max:255',
            'view_count' => 'nullable|numeric|max:255'
        ];
    }
}

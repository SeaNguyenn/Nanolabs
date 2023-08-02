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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'supplier_id' => 'required|exists:suppliers,id',
            'name' => 'required|string',
            'code' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'image' => 'nullable',
            'evaluate' => 'nullable|integer|between:0,5',
            'color' => 'nullable|string|max:255',
            'material' => 'nullable|string|max:255',
            'warranty' => 'nullable|integer|min:0',
            'view_count' => 'nullable|integer|min:0',
        ];
    }
}

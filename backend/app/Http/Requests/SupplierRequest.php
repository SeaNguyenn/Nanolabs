<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'brand_name' => 'required|string|unique:suppliers,brand_name',
            'avatar' => 'nullable|url',
            'email' => 'required|email|unique:suppliers,email',
            'evaluate' => 'nullable|integer|between:0,5',
            'phone' => 'nullable|digits:11',
            'address' => 'nullable|string',
            'state' => 'nullable|in:1,2'
        ];
    }
}

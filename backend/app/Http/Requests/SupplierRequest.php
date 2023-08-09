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
            'name' => 'required|string|unique:suppliers,name',
            'image' => 'nullable',
            'email' => 'required|email|unique:suppliers,email',
            'phone' => 'nullable',
            'address' => 'nullable|string',
            'is_active' => 'nullable|in:1,2'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'shipper_id' => 'required|exists:shippers,id',
            'shipping_method_id' => 'required|exists:shipping_methods,id',
            'user_id' => 'required|exists:users,id',
            'order_status' => 'required|in:1,2,3,4,5,6,7',
            'shipping_cost' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'note' => 'nullable|string',
            'order_date' => 'nullable|date',
            'shipped_date' => 'nullable|date',
            'required_date' => 'nullable|date',
            'state' => 'nullable|in:1,2'
        ];
    }
}

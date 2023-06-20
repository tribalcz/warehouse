<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required|unique:products,name,' . $this->route('product')->id,
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
            'supplier_id' => 'required|exists:suppliers,id',
            'warehouses' => 'required|exists:warehouse,id',
        ];
    }
}

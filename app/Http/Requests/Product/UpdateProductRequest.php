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
        $productId = $this->route('product') ? $this->route('product')->id : null;

        return [
            'name' => 'required|unique:products,name,' . $productId . '|min:10|max:80',
            'url' => 'required|unique:products,url,' . $productId . '|min:10|max:100',
            'description' => 'required|min:25|max:255',
            'content' => 'required|min:255',
            'price' => 'required|numeric',
            'weight' => 'required|numeric',
            'code' => 'required|min:8|max:13',
            'ean' => 'nullable|min:8|max:14',
            'qty' => 'required|numeric',
            'supplier_id' => 'required|exists:suppliers,id',
            'manufacturer_id' => 'required|exists:suppliers,id',
            'warehouses' => 'required|array|exists:warehouse,id',
            'images' => 'array',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}

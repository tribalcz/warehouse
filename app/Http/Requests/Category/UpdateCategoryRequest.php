<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
        $category_Id = $this->route('category') ? $this->route('category')->id : null;
        return [
            'name' => 'required|unique:categories,name,' . $category_Id,
            'parent_category' => 'nullable|exists:categories,id',
        ];
    }
}

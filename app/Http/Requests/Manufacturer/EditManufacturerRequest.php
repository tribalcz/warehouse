<?php

namespace App\Http\Requests\Manufacturer;

use Illuminate\Foundation\Http\FormRequest;

class EditManufacturerRequest extends FormRequest
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
        $manufacturerId = $this->route('manufacturer') ? $this->route('manufacturer')->id : null;

        return [
            'name' => 'required|unique:manufacturers,name,'.$manufacturerId,
            'description' =>'required',
        ];
    }
}

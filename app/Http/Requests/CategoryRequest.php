<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100|unique:categories,name',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'يجب إدخال اسم القسم',
            'name.string' => 'يجب أن يكون اسم القسم نصًا',
            'name.max' => 'يجب أن لا يتجاوز اسم القسم 100 حرفًا',
            'name.unique' => 'اسم القسم موجود بالفعل',
        ];
    }
}

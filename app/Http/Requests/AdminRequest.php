<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|string|min:6',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',         
            'password' => 'nullable|string|min:6|confirmed',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];

        
    }

    public function messages(): array
    {
        return [
            'name.required' => 'اسم المستخدم مطلوب',
            'password.min' => 'كلمة المرور يجب أن تكون على الأقل 6 أحرف',
            'photo.image' => 'الملف المرفوع يجب أن يكون صورة',
            'photo.mimes' => 'الملف المرفوع يجب أن يكون من نوع jpg, jpeg, png, gif',
            'photo.max' => 'الملف المرفوع يجب أن لا يتجاوز 2048 كيلوبايت',  
            'email.required' => 'الإيميل مطلوب ',
            'email.email' => 'هناك خطا في صيغة البريد الالكتروني',
            'location.string' => 'هناك خطا فالبيانات',
            'location.max' => 'يجب الا يكون اطول من 255 حرف',
            'description.string' => 'هناك خطا فالبيانات',

        ];
    }
}

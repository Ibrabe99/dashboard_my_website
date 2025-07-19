<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialLinkRequest extends FormRequest
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
            'facebook' => 'nullable|url',
            'x' => 'nullable|url',
            'instagram' => 'nullable|url',
            'telegram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'youtube' => 'nullable|url',
        ];
    }

    // رسائل الأخطاء المخصصة (اختياري)
    public function messages()
    {
        return [
            'facebook.url' => 'يجب ان يكون رابط',
            'x.url' => 'يجب ان يكون رابط',
            'instagram.url' => 'يجب ان يكون رابط',
            'telegram.url' => 'يجب ان يكون رابط',
            'linkedin.url' => 'يجب ان يكون رابط',
            'youtube.url' => 'يجب ان يكون رابط',
        ];
    }
}

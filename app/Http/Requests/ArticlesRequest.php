<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticlesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $imageRule = $this->isMethod('post') ? 'required|image|max:2048' : 'nullable|image|max:2048';

        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => $imageRule,
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'عنوان المقال مطلوب.',
            'title.max' => 'عنوان المقال لا يمكن أن يزيد عن 255 حرف.',
            'content.required' => 'محتوى المقال مطلوب.',
            'category_id.required' => 'التصنيف مطلوب.',
            'category_id.exists' => 'التصنيف غير موجود.',
            'image.required' => 'الصورة مطلوبة عند إضافة مقال جديد.',
            'image.image' => 'يجب أن تكون الصورة من نوع صورة صحيحة.',
            'image.max' => 'حجم الصورة لا يمكن أن يزيد عن 2 ميغابايت.',
        ];
    }
}

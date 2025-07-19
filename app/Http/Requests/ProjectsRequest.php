<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectsRequest extends FormRequest
{
    // السماح لكل المستخدمين (تقدر تضبطها حسب النظام)
    public function authorize()
    {
        return true;
    }

    // قواعد التحقق من الصحة
    public function rules()
    {
        // لما تكون العملية تحديث (PUT/PATCH) الصورة تكون اختيارية
        // لما تكون إنشاء (POST) الصورة تكون مطلوبة
       

        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:81920',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:81920',
            'slug' => 'nullable|string|max:255',
            'live_link' => 'nullable|string|max:255',
            'github_link' => 'nullable|string|max:255',
            'category_id' => 'nullable|integer|exists:categories,id',
        ];
    }

    // رسائل الأخطاء المخصصة (اختياري)
    public function messages()
    {
        return [
            'title.required' => 'العنوان مطلوب.',
            'title.max' => 'العنوان لا يمكن أن يزيد عن 255 حرف.',
            'images*.required' => 'الصورة مطلوبة عند إضافة مشروع جديد.',
            'images*.image' => 'يجب أن تكون الصورة من نوع صورة صحيحة.',
            'images*.max' => 'حجم الصورة لا يمكن أن يزيد عن 2 ميغابايت.',
            'image.image' => 'يجب أن تكون الصورة من نوع صورة صحيحة.',
            'image.max' => 'حجم الصورة لا يمكن أن يزيد عن 2 ميغابايت.',
            'slug.max' => 'الاسم المستعار لا يمكن أن يزيد عن 255 حرف.',
            'live_link.max' => 'رابط المشروع الحقيقي لا يمكن أن يزيد عن 255 حرف.',
            'github_link.max' => 'رابط المشروع على GitHub لا يمكن أن يزيد عن 255 حرف.',     
        ];
    }
}

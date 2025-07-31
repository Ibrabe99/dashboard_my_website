<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class CVController extends Controller
{
    /**
     * رفع ملف السيرة الذاتية
     */
    public function upload(Request $request)
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf|max:2048',
        ]);

        $folder = 'cvs';
        $filename = 'cv.pdf';

        // حذف القديم إن وُجد
        if (Storage::disk('public')->exists("$folder/$filename")) {
            Storage::disk('public')->delete("$folder/$filename");
        }

        // تخزين الملف بالاسم الثابت داخل مجلد public/cvs
        $request->file('cv')->storeAs($folder, $filename, 'public');

        // تأكد أن الملف تم حفظه بنجاح
        if (!Storage::disk('public')->exists("$folder/$filename")) {
            return response()->json(['error' => 'حدث خطأ أثناء حفظ الملف'], 500);
        }

        return response()->json([
            'message' => 'تم رفع السيرة الذاتية بنجاح',
            'url' => asset("storage/$folder/$filename"),
        ]);
    }

    /**
     * الحصول على رابط السيرة الذاتية
     */
    public function getCV()
    {
        $folder = 'cvs';
        $filename = 'cv.pdf';

        if (!Storage::disk('public')->exists("$folder/$filename")) {
            return response()->json(['error' => 'الملف غير موجود'], 404);
        }

        return response()->json([
            'cv_url' => asset("storage/$folder/$filename")
        ]);
    }
}

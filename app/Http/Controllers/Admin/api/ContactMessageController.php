<?php

namespace App\Http\Controllers\Admin\api;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $message = ContactMessage::create($data);

        // إرسال إيميل
        Mail::to('ibrahimbanour99@gmail.com')->send(new \App\Mail\ContactFormMail($message));

        return response()->json(['message' => 'تم إرسال الرسالة بنجاح']);
    }

    // API Controller method to get last 3 messages
    public function showMessages()
    {
        $messages = ContactMessage::all(); // تقسيم الصفحات 10 رسالة لكل صفحة

        return view('messages.index', compact('messages'));
    }


}

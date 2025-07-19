<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Social_link;
use App\Http\Requests\SocialLinkRequest;

class SocialLinkController extends Controller
{
    




    // حفظ التعديل
    public function update(SocialLinkRequest $request)
    {
        $data = $request->validated();
       
        $link = Social_link::first();

        if ($link) {
            $link->update($data);
            
        } else {
            Social_link::create($data);
            
        }

        

        return redirect()->back()->with('success', 'تم تحديث روابط مواقع التواصل بنجاح.');
    }
}

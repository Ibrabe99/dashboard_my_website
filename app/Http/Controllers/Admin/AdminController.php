<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminRequest;
use Illuminate\Routing\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Social_link;
use App\Models\Skill;


class AdminController extends Controller
{


    // عرض قائمة المدراء
    public function profile()
    {
        $admin = Admin::first(); // هذا يرجع أول سجل فقط من جدول الادمن
        $social = Social_link::first();
        $skills = Skill::all();
        return view('admin.profile', compact('admin','social','skills'));
    }
    



    public function edit()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.admins.edit_profile', compact('admin'));
    }
 
    


    public function update(AdminRequest $request)
    {
        $admin = Admin::first(); // لو عندك أدمن واحد

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->title = $request->summary;
        $admin->phone = $request->phone;
        $admin->location = $request->location;
        $admin->description = $request->description;
    
        if ($request->password) {
            $admin->password = Hash::make($request->password);
        }
    
        
        $admin->save();
    
        return redirect()->back()->with('success', 'تم تحديث البيانات بنجاح.');
    }



    


}

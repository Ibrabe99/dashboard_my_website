<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function getlogin()
    {
        return view('admin.auth.login');




//        $admin['name'] = 'admin';
//        $admin['title'] = 'Full-stack Developer';
//        $admin['email'] = 'admin@gmail.com';
//        $admin['number'] = '0900000000';
//        $admin['location'] = "بريبر";
//        $admin['description'] = "مبرمج فل ستاك بلارافيل ورياكت وغيرهم من اللغات الاخرى";
//        $admin['phone'] = "0924624861 / 0914838490";
//        $admin['photo'] = 'sssss';
//        $admin['password'] = bcrypt('123456');
//        Admin::create($admin);


    }


    public function login(LoginRequest $request)
    {
        if (auth()->guard('admin')->attempt(['name' => $request->input('name'), 'password' => $request->input('password')])) {

            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.login')->with(['error' => '  !! بيانات الدخول غير صحيحة ']);
        }
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}

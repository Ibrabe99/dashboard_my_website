<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function getlogin(){
        return view('admin.auth.login');


    }

    
    public function login(LoginRequest $request){
        if(auth()->guard('admin')->attempt(['username'=>$request->input('username'), 'password'=>$request->input('password')]))
        {
            return redirect()->route('admin.dashboard'); 
        }else{
            return redirect()->route('admin.login')->with(['error'=>'  !! بيانات الدخول غير صحيحة ']);
        }    
    }

    public function logout(){
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}

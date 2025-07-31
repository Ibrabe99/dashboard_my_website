<?php

namespace App\Http\Controllers\Admin\api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class ApiAdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all()->map(function ($admin) {
            $admin->image_url = $admin->photo ? asset('storage/' . $admin->photo) : null;
            return $admin;
        });

        return response()->json($admins, 200);
    }

    public function show()
    {
        $admin = Admin::first(); // يجيب أول إدمن في الجدول

        if (!$admin) {
            return response()->json(['message' => 'Admin not found'], 404);
        }

        $admin->image_url = $admin->image ? asset('storage/' . $admin->image) : null;

        return response()->json($admin, 200);
    }
}

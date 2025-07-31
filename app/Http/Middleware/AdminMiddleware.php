<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $isLoginRoute = $request->is('admin/login');
        $isAuthenticated = Auth::guard('admin')->check();

        // إذا كان الطلب لصفحة تسجيل الدخول والمستخدم مسجّل دخول، نعيده للداشبورد
        if ($isLoginRoute && $isAuthenticated) {
            return redirect()->route('admin/');
        }

        // إذا كان الطلب ليس لصفحة تسجيل الدخول والمستخدم غير مسجّل دخول، نعيده لصفحة اللوجين
        if (!$isLoginRoute && !$isAuthenticated) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}

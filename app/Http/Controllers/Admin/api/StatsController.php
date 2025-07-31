<?php

namespace App\Http\Controllers\Admin\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Article;
use App\Models\Visit;

class StatsController extends Controller
{

    public function trackVisit(Request $request)
    {
        $page = $request->input('page', 'غير معروف');
        $visitorIp = $request->ip();
        $userAgent = $request->userAgent();

        // سجل الزيارة دون تكرار IP لنفس الصفحة خلال 30 دقيقة مثلاً
        $recentVisit = Visit::where('visitor_ip', $visitorIp)
            ->where('page', $page)
            ->where('created_at', '>=', now()->subMinutes(30))
            ->first();

        if (!$recentVisit) {
            Visit::create([
                'visitor_ip' => $visitorIp,
                'user_agent' => $userAgent,
                'page' => $page,
                'type' => 'general', // نوع عام
            ]);
        }

        return response()->json(['message' => 'تم تسجيل زيارة الموقع']);
    }
    // دالة لتحديث المشاهدات واللايكات للمنشورات (projects, articles)
    public function updateStats(Request $request, $type, $id)
    {
        $action = $request->input('action');
        $visitorIp = $request->ip();

        // اختيار الموديل حسب النوع
        if ($type === 'projects') {
            $model = Project::find($id);
        } elseif ($type === 'articles') {
            $model = Article::find($id);
        } else {
            return response()->json(['message' => 'نوع غير صالح'], 400);
        }

        if (!$model) {
            return response()->json(['message' => 'المحتوى غير موجود'], 404);
        }

        // تحقق من عدم تكرار نفس الإجراء من نفس IP (يمكن تخفيض زمن التكرار حسب الحاجة)
        $timeLimit = now()->subHours(24);

        if ($action === 'view') {
            $recent = Visit::where('visitor_ip', $visitorIp)
                ->where('type', $type)
                ->where('content_id', $id)
                ->where('created_at', '>=', $timeLimit)
                ->where('page', 'like', "%/details/{$type}/{$id}%")
                ->first();

            if ($recent) {
                return response()->json(['message' => 'تم تسجيل مشاهدة مسبقاً'], 200);
            }

            // زيادة المشاهدات
            $model->increment('views');

            // سجل زيارة
            Visit::create([
                'visitor_ip' => $visitorIp,
                'user_agent' => $request->userAgent(),
                'page' => "/details/{$type}/{$id}",
                'type' => $type,
                'content_id' => $id,
            ]);

            return response()->json(['message' => 'تم تسجيل مشاهدة', 'views' => $model->views]);
        } elseif ($action === 'like') {
            // تحقق من وجود لايك مسبق لنفس الـ IP
            $recentLike = Visit::where('visitor_ip', $visitorIp)
                ->where('type', $type)
                ->where('content_id', $id)
                ->where('created_at', '>=', $timeLimit)
                ->where('page', 'like', "%/details/{$type}/{$id}%")
                ->where('action', 'like')
                ->first();

            if ($recentLike) {
                return response()->json(['message' => 'تم تسجيل إعجاب مسبقاً'], 200);
            }

            $model->increment('likes');

            Visit::create([
                'visitor_ip' => $visitorIp,
                'user_agent' => $request->userAgent(),
                'page' => "/details/{$type}/{$id}",
                'type' => $type,
                'content_id' => $id,
                'action' => 'like',  // تحتاج تعديل الـ migration ليشمل هذا الحقل إذا أردت
            ]);

            return response()->json(['message' => 'تم تسجيل إعجاب', 'likes' => $model->likes]);
        } else {
            return response()->json(['message' => 'إجراء غير صالح'], 400);
        }
    }
}

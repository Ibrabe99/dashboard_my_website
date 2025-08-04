<?php

namespace App\Providers;

use App\Models\ContactMessage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // تأكد من أن الجدول موجود لتجنب الخطأ أثناء التثبيت أو الترحيل
        if (Schema::hasTable('contact_messages')) {
            try {
                $latestMessages = ContactMessage::orderBy('created_at', 'desc')->take(3)->get();
                View::share('latestMessages', $latestMessages);
            } catch (\Exception $e) {
                // ممكن تسجل الخطأ في السجلات بدل ما يوقف الموقع
                \Log::error('Error fetching latest contact messages: ' . $e->getMessage());
            }
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Social_link extends Model
{
    use Notifiable;

    // اسم جدول الـ Admins
    protected $table = 'social_links';

    // نستخدم حرس 'admin' مع Spatie Permission
    protected $guard_name = 'admin';

    /**
     * الحقول القابلة للكتابة (Mass Assignment)
     * لا تدرج: id, created_at, updated_at، فهي تُدار أوتوماتيكياً
     */
    protected $fillable = [
        'facebook',
        'x',
        'instagram',
        'telegram',
        'linkedin',
        'youtube',
    ];

    /**
     * الحقول المخفية عند التحويل إلى JSON/Array
     */
    protected $hidden = [
        'created_at',
        'updated_at',

    ];
}

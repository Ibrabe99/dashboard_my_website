<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable;

    // اسم جدول الـ Admins
    protected $table = 'admins';

    // نستخدم حرس 'admin' مع Spatie Permission
    protected $guard_name = 'admin';

    /**
     * الحقول القابلة للكتابة (Mass Assignment)
     * لا تدرج: id, created_at, updated_at، فهي تُدار أوتوماتيكياً
     */
    protected $fillable = [
        'name',
        'password',
        'title',
        'location',
        'email',
        'description',
        'phone',
        'photo',
    ];

    /**
     * الحقول المخفية عند التحويل إلى JSON/Array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'password',
        'remember_token',
    ];

    /**
     * Casting للحفاظ على نوع البيانات
     */

}

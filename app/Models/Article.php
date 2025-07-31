<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Article extends Model
{
    use Notifiable;

    // اسم جدول الـ Admins
    protected $table = 'articles';

    // نستخدم حرس 'admin' مع Spatie Permission
    protected $guard_name = 'admin';

    /**
     * الحقول القابلة للكتابة (Mass Assignment)
     * لا تدرج: id, created_at, updated_at، فهي تُدار أوتوماتيكياً
     */
    protected $fillable = [
        'title',
        'slug',
        'image',
        'hijri_date',
        'day',
        'date',
        'time',
        'content',
        'category_id',
    ];

    /**
     * الحقول المخفية عند التحويل إلى JSON/Array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Casting للحفاظ على نوع البيانات
     */


     public function category()
     {
         return $this->belongsTo(Category::class);
     }

    public function images()
    {
        return $this->hasMany(ArticlesImage::class)->orderBy('article_id');
    }
}

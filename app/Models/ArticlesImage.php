<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticlesImage extends Model
{
    protected $table = 'articles_images';

    // نستخدم حرس 'admin' مع Spatie Permission
    protected $guard_name = 'admin';

    /**
     * الحقول القابلة للكتابة (Mass Assignment)
     * لا تدرج: id, created_at, updated_at، فهي تُدار أوتوماتيكياً
     */
    protected $fillable = [
        'article_id',
        'path',

    ];

    /**
     * الحقول المخفية عند التحويل إلى JSON/Array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    public function images()
    {
        return $this->hasMany(ArticlesImage::class);
    }
}

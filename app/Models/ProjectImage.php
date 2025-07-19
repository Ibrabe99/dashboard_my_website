<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{

    protected $table = 'project_images';

    // نستخدم حرس 'admin' مع Spatie Permission
    protected $guard_name = 'admin';

    /**
     * الحقول القابلة للكتابة (Mass Assignment)
     * لا تدرج: id, created_at, updated_at، فهي تُدار أوتوماتيكياً
     */
    protected $fillable = [
        'project_id',
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
        return $this->hasMany(ProjectImage::class);
    }
}

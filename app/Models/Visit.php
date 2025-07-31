<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'visitor_ip', 'user_agent', 'page', 'type', 'content_id', 'action'
    ];
}

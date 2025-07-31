<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_ip')->nullable();      // IP الزائر
            $table->string('user_agent')->nullable();      // متصفح الزائر
            $table->string('page')->nullable();            // صفحة الزيارة (الرابط)
            $table->string('action')->nullable();          // مثل 'view'
            $table->string('type')->nullable();            // project أو article أو general
            $table->unsignedBigInteger('content_id')->nullable(); // ID للمحتوى إن وجد
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visits');
    }
};

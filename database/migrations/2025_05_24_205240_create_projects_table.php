<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title',225);
            $table->string('slug',225)->unique(); // رابط مميز
            $table->string('image',225)->nullable(); // صورة للمشروع
            $table->text('description')->nullable(); // وصف
            $table->string('hijri_date')->nullable();
            $table->string('day')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('likes')->default(0);
            $table->string('live_link')->nullable(); // رابط المعاينة
            $table->string('github_link')->nullable(); // رابط GitHub
            $table->boolean('is_active')->default(true);
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['views', 'likes']);
        });
    }


};

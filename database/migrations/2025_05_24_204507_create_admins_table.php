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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('password',225);
            $table->string('title', 100)->nullable();
            $table->string('location', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('description', 3000)->nullable();
            $table->string('phone', 100)->nullable();
            $table->string('photo', 225)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};

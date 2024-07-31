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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // عمود الاسم
            $table->string('code')->default(''); // عمود الرمز مع قيمة افتراضية فارغة
            $table->string('type')->nullable(); // عمود النوع (اختياري)
            $table->timestamps(); // أعمدة التوقيتات
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};

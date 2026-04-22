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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('circle_student_id')->constrained('circle_student')->onDelete('cascade');
            $table->foreignId('surah_id')->constrained('surahs')->onDelete('cascade');
            $table->enum('method', ['ayah', 'page']);
            $table->unsignedSmallInteger('from');
            $table->unsignedSmallInteger('to');
            $table->date('exam_date');
            $table->unsignedSmallInteger('grade')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};

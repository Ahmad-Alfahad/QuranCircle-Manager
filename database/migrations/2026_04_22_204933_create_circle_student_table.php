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
        Schema::create('circle_student', function (Blueprint $table) {
            $table->id();

            $table->foreignId('circle_id')->constrained('circles')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->unique(['circle_id', 'student_id']);
            $table->string('status')->default('pending'); // pending, accepted, rejected
            $table->date('joined_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('circle_student');
    }
};

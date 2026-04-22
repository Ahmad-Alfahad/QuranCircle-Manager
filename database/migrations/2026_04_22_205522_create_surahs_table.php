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
        Schema::create('surahs', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // the name of the surah in Arabic
            $table->unsignedSmallInteger('total_ayahs'); // the total number of ayahs in the surah
            $table->unsignedSmallInteger('order'); // the order of the surah in the Quran
            $table->unsignedSmallInteger('juz'); // the juz number of the surah
            $table->unsignedSmallInteger('hizb'); // the hizb number of the surah
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surahs');
    }
};

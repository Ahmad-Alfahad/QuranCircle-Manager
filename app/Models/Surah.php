<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surah extends Model
{
    //
    public function records()
    {
        return $this->hasMany(Record::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
    
}

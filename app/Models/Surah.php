<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surah extends Model
{
    //
    public function record ()
    {
        return $this->hasMany(Record::class);
    }

    public function exam()
    {
        return $this->hasMany(Exam::class);
    }
}

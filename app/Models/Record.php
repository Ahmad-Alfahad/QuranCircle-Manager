<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    //
    public function surah()
    {
        return $this->belongsTo(Surah::class);
    }

    public function CircleStudent()
    {
        return $this->belongsTo(CircleStudent::class);
    }
}

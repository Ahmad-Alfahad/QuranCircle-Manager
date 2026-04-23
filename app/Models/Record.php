<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    //

    protected $fillable = [
        'circle_student_id',
        'surah_id',
        'type',
        'method',
        'from',
        'to',
        'recorded_at',
        'grade',
        'notes'
    ];
    public function surah()
    {
        return $this->belongsTo(Surah::class);
    }

    public function circleStudent()
    {
        return $this->belongsTo(CircleStudent::class);
    }
}

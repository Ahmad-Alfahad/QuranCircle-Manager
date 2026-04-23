<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //

    protected $fillable = [
                'circle_student_id',
        'surah_id',
        'method',
        'from',
        'to',
        'date',
        'grade',
        'notes'
    ];
    public function circleStudent()
    {
        return $this->belongsTo(CircleStudent::class, 'circle_student_id');
    }

    public function surah()
    {
        return $this->belongsTo(Surah::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //
    public function circleStudent()
    {
        return $this->belongsTo(CircleStudent::class, 'circle_student_id');
    }
}

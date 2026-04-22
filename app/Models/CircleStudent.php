<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CircleStudent extends Model
{
    //
    protected $table = 'circle_student';
    protected $fillable = [
        'circle_id',
        'student_id',
        'status',
        'joined_at',
    ];

    public function circle()
    {
        return $this->belongsTo(Circle::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function records()
    {
        return $this->hasMany(Record::class, 'circle_student_id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'circle_student_id');
    }
    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'circle_student_id');
    }
}

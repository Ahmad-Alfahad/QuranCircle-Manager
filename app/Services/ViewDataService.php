<?php
namespace App\Services;
use App\Models\Circle;
use App\Models\CircleStudent;
use App\Models\Surah;

class ViewDataService {
    public function getFiltersData($user) {
        
        // Admin can see all circles and students
        if($user->role == 'admin') {
            return [
                'circles' => Circle::select('id', 'name')
                ->get(),
                'circleStudents' => CircleStudent::with('student:id,name')
                ->get(),
            ];
        }
        // Teacher can see only their circles and students
        elseif($user->role ==' teacher') {
            return [
                'circles' => Circle::where('teacher_id' , $user->id)
                ->select('id', 'name')
                ->get(),
                'circleStudent' => CircleStudent::whereHas('circle', function($q) use ($user) {
                    $q->where('teacher_id' , $user->id);
                })->with('student' , 'circle')->get(),
            ];
        }
        // Student can see only their circles and themselves
        elseif($user->role == 'student') {
            return [
                'circles' => Circle::whereHas('circleStudents', function($q) use ($user) {
                    $q->where('student_id' , $user->id);
                })->select('id', 'name')->get(),
                'circleStudents' => CircleStudent::where('student_id' , $user->id)
                ->with('student:id,name', 'circle:id,name')
                ->get(),
            ];
        }
        // Default empty data for other roles
        return [
            'circles' => collect(),
            'circleStudents' => collect(),
        ];
    }

        public function getSurahsData() {
            return Surah::select('id', 'name')->get();
        }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Circle;
use App\Models\Record;
use App\Models\Attendance;

class DashboardController extends Controller
{
    //
    public function index()
{
    $user = auth()->user();

    // 🟢 Admin
    if ($user->role == 'admin') {

        $stats = [
            'students' => User::where('role', 'student')->count(),
            'teachers' => User::where('role', 'teacher')->count(),
            'circles' => Circle::count(),
            'records' => Record::count(),
            'attendance' => Attendance::count(),
        ];

        $recentRecords = Record::with('circleStudent.student')
            ->latest()
            ->take(5)
            ->get();

        $recentAttendance = Attendance::latest()
            ->take(5)
            ->get();
    }

    // 🟡 Teacher
    elseif ($user->role == 'teacher') {

        $stats = [
            'students' => User::whereHas('circleStudents.circle', function ($q) use ($user) {
                $q->where('teacher_id', $user->id);
            })->count(),

            'circles' => Circle::where('teacher_id', $user->id)->count(),

            'records' => Record::whereHas('circleStudent.circle', function ($q) use ($user) {
                $q->where('teacher_id', $user->id);
            })->count(),
        ];

        $recentRecords = Record::whereHas('circleStudent.circle', function ($q) use ($user) {
            $q->where('teacher_id', $user->id);
        })
        ->with('circleStudent.student')
        ->latest()
        ->take(5)
        ->get();

        $recentAttendance = Attendance::whereHas('circleStudent.circle', function ($q) use ($user) {
            $q->where('teacher_id', $user->id);
        })
        ->latest()
        ->take(5)
        ->get();
    }

    // 🔵 Student
    else {

        $stats = [
            'records' => Record::whereHas('circleStudent', function ($q) use ($user) {
                $q->where('student_id', $user->id);
            })->count(),

            'attendance' => Attendance::whereHas('circleStudent', function ($q) use ($user) {
                $q->where('student_id', $user->id);
            })->count(),
        ];

        $recentRecords = Record::whereHas('circleStudent', function ($q) use ($user) {
            $q->where('student_id', $user->id);
        })
        ->latest()
        ->take(5)
        ->get();

        $recentAttendance = Attendance::whereHas('circleStudent', function ($q) use ($user) {
            $q->where('student_id', $user->id);
        })
        ->latest()
        ->take(5)
        ->get();
    }

    return view('dashboard', compact('stats', 'recentRecords', 'recentAttendance'));
}
}

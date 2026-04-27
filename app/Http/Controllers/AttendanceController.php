<?php

namespace App\Http\Controllers;

use App\Models\CircleStudent;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Circle;

class AttendanceController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = auth()->user();

        $circleId = $request->circle_id;
        $studentId = $request->student_id;
        $query = Attendance::with('circleStudent.student', 'circleStudent.circle');
        // 🔐 Authorization
        if ($user->role == 'teacher') {
            $query->whereHas('circleStudent.circle', function ($q) use ($user) {
                $q->where('teacher_id', $user->id);
            });
        } elseif ($user->role == 'student') {
            $query->whereHas('circleStudent', function ($q) use ($user) {
                $q->where('student_id', $user->id);
            });
        } elseif ($user->role != 'admin') {
            abort(403);
        }

        // 🎯 Filters
        if ($circleId) {
            $query->whereHas('circleStudent', function ($q) use ($circleId) {
                $q->where('circle_id', $circleId);
            });
        }

        if ($studentId) {
            $query->whereHas('circleStudent', function ($q) use ($studentId) {
                $q->where('student_id', $studentId);
            });
        }

        $attendance = $query->latest()->get();
        // 🎨 Filter Data
          if ($user->role == 'admin') {
        $circles = Circle::all();
        $circleStudents = CircleStudent::with('student', 'circle')->get();
    }
    elseif ($user->role == 'teacher') {
        $circles = Circle::where('teacher_id', $user->id)->get();
        $circleStudents = CircleStudent::with('student', 'circle')
            ->whereHas('circle', function ($q) use ($user) {
                $q->where('teacher_id', $user->id);
            })
            ->get();
    } elseif ($user->role == 'student') {
        $circles = Circle::whereHas('circleStudents', function ($q) use ($user) {
            $q->where('student_id', $user->id);
        })->get();
        $circleStudents = CircleStudent::with('student', 'circle')
            ->where('student_id', $user->id)
            ->get();
    } else {
        $circles = collect();
        $circleStudents = collect();
    }

return view('attendance.index', compact(
        'attendance',
        'circles',
        'circleStudents'
    ));   
     }

    public function create()
{
    if (!in_array(auth()->user()->role, ['admin', 'teacher'])) {
        abort(403);
    }

    $user = auth()->user();

    if ($user->role == 'teacher') {
        $circleStudents = CircleStudent::whereHas('circle', function ($q) use ($user) {
            $q->where('teacher_id', $user->id);
        })->with('student')->get();
    } else {
        $circleStudents = CircleStudent::with('student')->get();
    }

    return view('attendance.create', compact('circleStudents'));
}


    public function store(Request $request)
    { //dd($request->only(['circle_student_id', 'date', 'status','notes']));
    if (!in_array(auth()->user()->role, ['admin', 'teacher'])) {
        abort(403);
    }
        $request->validate([
            'circle_student_id' => 'required|exists:circle_student,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late',
        ]);

        // 🔥 منع التكرار (حتى لو نسيت unique constraint)
        $exists = Attendance::where('circle_student_id', $request->circle_student_id)
            ->where('date', $request->date)
            ->exists();

        if ($exists) {
            return back()->withErrors(['date' => 'Attendance already recorded for this day']);
        }

        // Attendance::create($request->only(['circle_student_id', 'date', 'status','notes']));
        Attendance::create($request->all());
        return redirect()->route('attendance.index')->with('success', 'Saved');
    }
    public function edit(Attendance $attendance)
    {
        $students = CircleStudent::with('student')->get();
        return view('attendance.edit', compact('attendance', 'students'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'circle_student_id' => 'required',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late',
        ]);

        $attendance->update($request->all());

        return redirect()->route('attendance.index')->with('success', 'Updated');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('attendance.index')->with('success', 'Deleted');
    }
}

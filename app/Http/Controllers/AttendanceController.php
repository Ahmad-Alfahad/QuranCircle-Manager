<?php

namespace App\Http\Controllers;

use App\Models\CircleStudent;
use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    //
    public function index()
    {
        $attendance = Attendance::with('circleStudent.student')->latest()->get();
        return view('attendance.index', compact('attendance'));
    }

    public function create()
    {
        $students = CircleStudent::with('student')->get();
        return view('attendance.create', compact('students'));
    }


    public function store(Request $request)
    { //dd($request->only(['circle_student_id', 'date', 'status','notes']));
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

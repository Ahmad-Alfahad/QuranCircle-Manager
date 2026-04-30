<?php

namespace App\Http\Controllers;

use App\Models\CircleStudent;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Circle;
use App\Services\AttendanceService;

class AttendanceController extends Controller
{
    //
    public function index(Request $request , AttendanceService $attendanceService)
    {
        $user = auth()->user();
        
        $filter = $request->only([
            'circle_id',
            'student_id',
        ]);

        $attendance = $attendanceService->list($user , $filter) ;
        
       
        // 🎨 Filter Data
        if ($user->role == 'admin') {
            $circles = Circle::all();
            $circleStudents = CircleStudent::with('student', 'circle')->get();
        } elseif ($user->role == 'teacher') {
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

    public function show(Attendance $attendance)
    {
        // 🔐 Authorization
        $user = auth()->user();
        if ($user->role == 'teacher' && $attendance->circleStudent->circle->teacher_id != $user->id) {
            abort(403);
        }
        if ($user->role == 'student' && $attendance->circleStudent->student_id != $user->id) {
            abort(403);
        }
        $attendance->load('circleStudent.student', 'circleStudent.circle');

        return view('attendance.show', compact('attendance'));
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

        $attendance->update([
            'circle_student_id' => $request->circle_student_id,
            'date' => $request->date,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);
//  dd($request->all());
return redirect()->to($request->redirect_to ?? route('dashboard'))
    ->with('success', 'updated');    }

    public function destroy(Attendance $attendance , Request $request)
    {
        $attendance->delete();

return redirect()->to($request->redirect_to ?? url()->previous())
    ->with('success', 'deleted');        }
}

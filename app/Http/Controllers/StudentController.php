<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Circle;
use App\Models\CircleStudent;
use App\Models\Record;
use App\Models\Attendance;


class StudentController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();

        // 🟢 Admin
        if ($user->role == 'admin') {
            $students = User::where('role', 'student')->get();
        }

        // 🟡 Teacher
        elseif ($user->role == 'teacher') {
            $students = User::whereHas('circleStudents.circle', function ($q) use ($user) {
                $q->where('teacher_id', $user->id);
            })->get();
        }

        // 🔵 Student
        else {
            abort(403);
        }

        return view('students.index', compact('students'));
    }


    public function show(User $user)
    {
        // تحميل العلاقات
        // dd($user);
        
        $user->load('circleStudents.circle');
        // إذا لم يكن مربوط بأي حلقة
        if ($user->circleStudents->isEmpty()) {

            return back()->with('error', 'This user is not assigned to any circle');
        }
        //dd($user);
        // records
        $records = Record::whereHas('circleStudent', function ($q) use ($user) {
            $q->where('student_id', $user->id);
        })
            ->with('surah', 'circleStudent.circle')
            ->latest()
            ->get();

        // attendance
        $attendance = Attendance::whereHas('circleStudent', function ($q) use ($user) {
            $q->where('student_id', $user->id);
        })
            ->latest()
            ->get();

        return view('students.show', [
            'user' => $user,
            'circleStudents' => $user->circleStudents,
            'records' => $records,
            'attendance' => $attendance
        ]);
    }


    public function create()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403);
        }

        $circles = Circle::all();
        return view('students.create', compact('circles'));
    }

    public function store(Request $request)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'circle_id' => 'required|exists:circles,id',
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        // create student
        $student = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student'
        ]);

        // attach to circle
        CircleStudent::create([
            'circle_id' => $request->circle_id,
            'student_id' => $student->id,
            'joined_at' => now()
        ]);

        return redirect()->route('students.index')->with('success', 'Student created');
    }

    public function edit(User $user)
    {
        $circles = Circle::all();
        return view('students.edit', compact('user', 'circles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('students.index')->with('success', 'Updated');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('students.index')->with('success', 'Deleted');
    }

    public function records(User $user ) {
        if(auth()->user()->role == 'student' && auth()->id() != $user->id) {
            abort(403);
        }
      
        $records = Record::whereHas('circleStudent', function ($q) use ($user) {
            $q->where('student_id', $user->id);
        })
            ->with('surah', 'circleStudent.circle')
            ->latest()
            ->get();

        return view('students.records', compact('records' , 'user'));

    }

    public function attendance( User $user ) {
        if(auth()->user()->role == 'student' && auth()->id() != $user->id) {
            abort(403);
        }
      
           
        
        $attendance = Attendance::whereHas('circleStudent', function ($q) use ($user) {
            $q->where('student_id', $user->id);
        })
            ->latest()
            ->get();

        return view('students.attendance', compact('attendance' , 'user'));

    }
}

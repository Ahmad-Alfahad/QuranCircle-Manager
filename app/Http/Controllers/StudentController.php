<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Circle;
use App\Models\CircleStudent;


class StudentController extends Controller
{
    //
    public function index(){
        $students = User::where('role' , 'student')->get();
        return view('students.index' , compact('students')) ;
    }

    public function create(){
        $circles = Circle::all();
        return view('students.create' , compact('circles'));
    }

        public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'circle_id' => 'required|exists:circles,id'
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

      public function edit(User $student)
    {
        $circles = Circle::all();
        return view('students.edit', compact('student', 'circles'));
    }

      public function update(Request $request, User $student)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('students.index')->with('success', 'Updated');
    }

    public function destroy(User $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Deleted');
    }

}

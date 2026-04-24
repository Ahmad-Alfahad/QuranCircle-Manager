<?php

namespace App\Http\Controllers;
use App\Models\Circle;
use App\Models\User;
use App\Models\CircleStudent;
use Illuminate\Http\Request;

class CircleController extends Controller
{
    //
    public function index()
    {
        $circles = Circle::with('teacher')->get();
        return view('circles.index', compact('circles'));
    }

    public function show(Circle $circle)
    {
        $circle->load('teacher', 'circleStudents.student');

        return view('circles.show', compact('circle'));
    }

    public function create()
    {
        $teachers = User::where('role', 'teacher')->get();
        return view('circles.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'teacher_id' => 'required|exists:users,id'
        ]);

        Circle::create($request->all());

        return redirect()->route('circles.index')->with('success', 'Circle created');
    }


    public function edit(Circle $circle)
    {
        $teachers = User::where('role', 'teacher')->get();
        return view('circles.edit', compact('circle', 'teachers'));
    }

    public function update(Request $request, Circle $circle)
    {
        $request->validate([
            'name' => 'required',
            'teacher_id' => 'required|exists:users,id'
        ]);

        $circle->update($request->all());

        return redirect()->route('circles.index')->with('success', 'Circle updated');
    }

    public function destroy(Circle $circle)
    {
        $circle->delete();
        return redirect()->route('circles.index')->with('success', 'Deleted');
    }

    public function removeStudent($id)
{
    CircleStudent::findOrFail($id)->delete();

    return back()->with('success', 'Student removed');
}
}

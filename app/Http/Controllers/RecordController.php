<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Record;
use App\Models\CircleStudent;
use App\Models\Surah;
use App\Models\Circle;

class RecordController extends Controller
{
    //

    public function index(Request $request)
    {
        $user = auth()->user();

        $circleId = $request->circle_id;
        $studentId = $request->student_id;
        $surahId = $request->surah_id;

        // 🧠 1. Base Query
        $query = Record::with('circleStudent.student', 'circleStudent.circle', 'surah');

        // 🔐 2. Authorization
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

        // 🎯 3. Filters (تعمل معًا)
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

        if ($surahId) {
            $query->where('surah_id', $surahId);
        }

        $records = $query->latest()->get();

        // 🎨 4. Filters Data (UI)

        if ($user->role == 'admin') {
            $circles = Circle::all();
            $circleStudents = CircleStudent::with('student', 'circle')->get();
        } elseif ($user->role == 'teacher') {
            $circles = Circle::where('teacher_id', $user->id)->get();
            $circleStudents = CircleStudent::whereHas('circle', function ($q) use ($user) {
                $q->where('teacher_id', $user->id);
            })->with('student', 'circle')->get();
        } elseif ($user->role == 'student') {
            $circles = Circle::whereHas('circleStudents', function ($q) use ($user) {
                $q->where('student_id', $user->id);
            })->get();

            $circleStudents = CircleStudent::where('student_id', $user->id)
                ->with('student', 'circle')
                ->get();
        } else {
            abort(403);
        }

        $surahs = Surah::all();

        return view('records.index', compact(
            'records',
            'circles',
            'circleStudents',
            'surahs'
        ));
    }

    public function create()
    {
        $user = auth()->user();
        if ($user->role == 'admin') {
            $students = CircleStudent::with('student')->get();
        } elseif ($user->role == 'teacher') {
            $students = CircleStudent::whereHas('circle', function ($q) use ($user) {
                $q->where('teacher_id', $user->id);
            })->with('student')->get();
        } else {
            abort(403);
        }
        $surahs = Surah::all();
        return view('records.create', compact('students', 'surahs'));
    }

    public function store(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin', 'teacher'])) {
            abort(403);
        }
        $request->validate([
            'circle_student_id' => 'required|exists:circle_student,id',
            'surah_id' => 'required|exists:surahs,id',
            'type' => 'required|in:memorization,revision',
            'method' => 'required|in:ayah,page',
            'recorded_at' => 'required|date',
        ]);
        $data = $request->all();
        $data['recorded_at'] = $request->recorded_at;
        Record::create($data);

        return redirect()->route('records.index')->with('success', 'Saved');
    }

    public function edit(Record $record)
    {
        $students = CircleStudent::with('student')->get();
        $surahs = Surah::all();

        return view('records.edit', compact('record', 'students', 'surahs'));
    }

    public function update(Request $request, Record $record)
    {
        $request->validate([
            'circle_student_id' => 'required',
            'surah_id' => 'required',
        ]);

        $record->update($request->all());

        return redirect()->route('records.index')->with('success', 'Updated');
    }

    public function destroy(Record $record)
    {
        $record->delete();
        return redirect()->route('records.index')->with('success', 'Deleted');
    }


}

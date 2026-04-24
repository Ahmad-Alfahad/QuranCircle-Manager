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
        $circleId = $request->circle_id;
        $studentId = $request->student_id;

        $records = Record::with('circleStudent.student', 'circleStudent.circle', 'surah')

            ->when($circleId, function ($query) use ($circleId) {
                $query->whereHas('circleStudent', function ($q) use ($circleId) {
                    $q->where('circle_id', $circleId);
                });
            })

            ->when($studentId, function ($query) use ($studentId) {
                $query->whereHas('circleStudent', function ($q) use ($studentId) {
                    $q->where('student_id', $studentId);
                });
            })

            ->latest()
            ->get();

        $circles = Circle::all();
        $students = CircleStudent::with('student')->get();

        return view('records.index', compact('records', 'circles', 'students'));
    }

    public function create()
    {
        $students = CircleStudent::with('student')->get();
        $surahs = Surah::all();

        return view('records.create', compact('students', 'surahs'));
    }

    public function store(Request $request)
    {
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

<x-app-layout>
    <h2>Student info</h2>
    <p>Student: {{ $user->name }}</p>

    <p>Email: {{ $user->email }}</p>

    <hr>

    <h3>Circles</h3>
    @foreach($circleStudents as $cs)
        <p> Circle Name : {{ $cs->circle->name }}</p>
    @endforeach

    
<div>
    <p>Total Records: {{ $records->count() }}</p>
    <p>Total Attendance: {{ $attendance->count() }}</p>

    @php
        $present = $attendance->where('status', 'present')->count();
        $total = $attendance->count();
        $percentage = $total ? round(($present / $total) * 100) : 0;
    @endphp

    <p>Attendance Rate: {{ $percentage }}%</p>
</div>

@php
    $last = $records->first();
@endphp

@if($last)
    <h4>Last Record</h4>
    <p>{{ $last->surah->name }}</p>

    <p>
    Method : {{$last->method}} from ({{ $last->from }}) → to ({{ $last->to }})
     </p>

     <p>Type : {{ $last->type }}</p>
     <p>Date : {{ $last->recorded_at ?? $last->date }} </p>
    </p>
@endif

<div style="margin-top:20px;">

    <a href="{{ route('students.records', $user) }}"
       style="padding:10px; background:#4CAF50; color:white;">
        View Records
    </a>

    <a href="{{ route('students.attendance', $user) }}"
       style="padding:10px; background:#2196F3; color:white;">
        View Attendance
    </a>

</div>

</x-app-layout>
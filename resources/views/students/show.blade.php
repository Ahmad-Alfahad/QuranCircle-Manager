<x-app-layout>
    <h2>Student info</h2>
    <p>Student: {{ $user->name }}</p>

    <p>Email: {{ $user->email }}</p>

    <hr>

    <h3>Circles</h3>
    @foreach($circleStudents as $cs)
        <p> Circle Name : {{ $cs->circle->name }}</p>
    @endforeach

    <hr>

    <h3>Records</h3>
    @foreach($records as $record)
        <p>
            <p>Circle Name : {{ $record->circlestudent->circle->name}} </p>
            <p> Surah Name : <<{{ $record->surah->name }}>></p>
            <p>Method : {{$record->method}} from ({{ $record->from }}) → to ({{ $record->to }})</p>
            <p>Type : {{ $record->type }}</p>
            <p>Date : {{ $record->recorded_at ?? $record->date }} </p>
        </p>
    @endforeach

    <hr>

    <h3>Attendance</h3>
    @foreach($attendance as $att)
        <p>
            {{ $att->date }} - {{ $att->status }}
        </p>
    @endforeach

</x-app-layout>
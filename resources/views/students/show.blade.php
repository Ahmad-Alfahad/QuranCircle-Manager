<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Student Details
            </h2>

            <div class="space-x-2">
                <button><a href="{{ route('students.records', $user) }}"
                        class="bg-green-500 text-white p-2 rounded hover:bg-green-600">
                        View Records
                    </a></button>
                <button><a href="{{ route('students.attendance', $user) }}"
                        class="bg-green-500 text-white p-2 rounded hover:bg-green-600">
                        View Attendance
                    </a></button>
            </div>
    </x-slot>
    <div class="bg-gray-100 p-6 flex  space-x-10 rounded shadow max-w-xl m-6">
        <div>Student Name : {{ $user->name }}</div>
        <div> Email : {{ $user->email }}</div>
    </div>
    <div class="bg-gray-100 p-6 rounded shadow max-w-xl m-6">
        <h3> Related Circles</h3>
        @foreach($circleStudents as $cs)
            <p> Circle Name : {{ $cs->circle->name }}</p>
        @endforeach
    </div>

    <div class="bg-white p-6 rounded shadow max-w-xl m-6 flex space-x-10">
        <div class="bg-gray-100 shadow p-2">Total Records: {{ $records->count() }}</div>
        <div class="bg-gray-100 shadow p-2">Total Attendance: {{ $attendance->count() }}</div>

        @php
            $present = $attendance->where('status', 'present')->count();
            $total = $attendance->count();
            $percentage = $total ? round(($present / $total) * 100) : 0;
        @endphp

        <div class="bg-gray-100 shadow p-2">Attendance Rate: {{ $percentage }}%</div>
    </div>

    @php
        $last = $records->first();
    @endphp

    @if($last)
        <div class="bg-white shadow p-6">
            <div class="bg-gray-100 shadow p-2">Last Record</div>
            <div class="p-1"> Surah : {{ $last->surah->name }}</div>

            <div class="p-1">
                Method : {{$last->method}} from ({{ $last->from }}) → to ({{ $last->to }})
            </div>

            <div class="p-1">Type : {{ $last->type }}</div>
            <div class="p-1">Date : {{ $last->recorded_at ?? $last->date }} </div>
            <div class="p-1">Grade : {{ $last->grade ?? 'No Grate' }} </div>
        </div>
    @endif

    <a href="{{ route('students.index') }}" class="text-gray-500 text-sm mb-3 inline-block">
        ← Back
    </a>

</x-app-layout>
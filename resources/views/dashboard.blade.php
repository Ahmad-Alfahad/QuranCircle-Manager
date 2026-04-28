<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @foreach($stats as $key => $value)
        <div style="display:inline-block; margin:10px; padding:15px; border:1px solid #ccc;">
            <h3>{{ ucfirst($key) }}</h3>
            <p>{{ $value }}</p>
        </div>
    @endforeach


<h3>Recent Records</h3>

@foreach($recentRecords as $r)
    <p>
        {{ $r->circleStudent->student->name ?? '' }}
        - {{ $r->surah->name ?? '' }}
    </p>
@endforeach
<h3>Recent Attendance</h3>

@foreach($recentAttendance as $a)
    <p>
        {{ $a->date }} - {{ $a->status }}
    </p>
@endforeach
</x-app-layout>

<x-app-layout>
    <h2>Records</h2>


    filter by circle
    <form action="" method="GET">
            filter by circle
        <select name="circle_id" onchange="this.form.submit()">
            <option value="">All Circles</option>
            @foreach($circles as $circle)
                <option value="{{ $circle->id }}" {{ request('circle_id') == $circle->id ? 'selected' : '' }}>
                    {{ $circle->name }}
                </option>
            @endforeach
        </select>
        @if (in_array(auth()->user()->role, ['admin', 'teacher']))
        filter by student
        <select name="student_id" id="" onchange="this.form.submit()">
            <option value="">All Students</option>
            @foreach($circleStudents->pluck('student')->unique() as $student)
                <option value="{{ $student->id }}" {{ request('student_id') == $student->id ? 'selected' : '' }}>
                    {{ $student->name }}
                </option>
            @endforeach
        </select>
        @endif
        
            filter by surah
            <select name="surah_id" id="" onchange="this.form.submit()">
                <option value="">All Surahs</option>
                @foreach($surahs as $surah)
                    <option value="{{ $surah->id }}" {{ request('surah_id') == $surah->id ? 'selected' : '' }}>
                        {{ $surah->name }}
                    </option>
                @endforeach
            </select>
    </form>

    @foreach($records as $record)
        <p>
            {{ $record->circleStudent->student->name }}
            - {{ $record->circleStudent->circle->name }}
            - {{ $record->surah->name }}

            -
            {{ $record->from}} → {{ $record->to }}


            - {{ $record->type }}
            - {{ $record->recorded_at ?? $record->date }}
            @if(in_array(auth()->user()->role, ['admin', 'teacher']))
                    <a href="{{ route('records.edit', $record) }}">Edit</a>
                <form method="post" action="{{ route('records.destroy', $record->id) }}" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            @endif
        </p>
    @endforeach
    @if(in_array(auth()->user()->role, ['admin', 'teacher']))
        <a href="{{ route('records.create') }}">Add Record</a>
    @endif

</x-app-layout>
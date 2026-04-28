<x-app-layout>
    <h2>Records</h2>


    filter by circle
    <form action="" method="GET">
            filter by circle
        <select name="circle_id" >
            <option value="">All Circles</option>
            @foreach($circles as $circle)
                <option value="{{ $circle->id }}" {{ request('circle_id') == $circle->id ? 'selected' : '' }}>
                    {{ $circle->name }}
                </option>
            @endforeach
        </select>
        @if (in_array(auth()->user()->role, ['admin', 'teacher']))
        filter by student
        <select name="student_id" id="" >
            <option value="">All Students</option>
            @foreach($circleStudents->pluck('student')->unique() as $student)
                <option value="{{ $student->id }}" {{ request('student_id') == $student->id ? 'selected' : '' }}>
                    {{ $student->name }}
                </option>
            @endforeach
        </select>
        @endif
        
            filter by surah
            <select name="surah_id" id="" >
                <option value="">All Surahs</option>
                @foreach($surahs as $surah)
                    <option value="{{ $surah->id }}" {{ request('surah_id') == $surah->id ? 'selected' : '' }}>
                        {{ $surah->name }}
                    </option>
                @endforeach
            </select>
          <button>Filter</button>
    </form>
    @if(in_array(auth()->user()->role, ['admin', 'teacher']))
    <a href="{{ route('records.create') }}">+ Add Record</a>
@endif


<table>
    <thead>
        <tr>

            @if(auth()->user()->role != 'student')
                <th>Student</th>
                <th>Circle</th>
            @endif

            <th>Surah</th>
            <th>Range</th>
            <th>Type</th>
            <th>Grade</th>
            <th>Date</th>

            @if(in_array(auth()->user()->role, ['admin', 'teacher']))
                <th>Actions</th>
            @endif

        </tr>
    </thead>

    <tbody>
        @foreach($records as $record)
            <tr>

                @if(auth()->user()->role != 'student')
                    <td>{{ $record->circleStudent->student->name }}</td>
                    <td>{{ $record->circleStudent->circle->name }}</td>
                @endif

                <td>{{ $record->surah->name }}</td>

                <td>
                
                        {{ $record->from }} → {{ $record->to }}
                  
                </td>

                <td>{{ $record->type }}</td>
                <td>{{ $record->grade }}</td>
                <td>{{ $record->recorded_at }}</td>
                

                @if(in_array(auth()->user()->role, ['admin', 'teacher']))
                    <td>
                        <a href="{{ route('records.edit', $record->id) }}">Edit</a>

                        @if(auth()->user()->role == 'admin')
                            <form method="POST" action="{{ route('records.destroy', $record->id) }}">
                                @csrf
                                @method('DELETE')
                                <button>Delete</button>
                            </form>
                        @endif
                    </td>
                @endif

            </tr>
        @endforeach
    </tbody>
</table>

</x-app-layout>
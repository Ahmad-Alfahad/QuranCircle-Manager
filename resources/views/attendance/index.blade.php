<x-app-layout>
    @section('title', 'Attendance')
    @section('breadcrumbs')
    Dashboard / Attendance
    @endsection
    <h2>Attendance</h2>
    @if(in_array(auth()->user()->role, ['admin', 'teacher']))
    <a href="{{ route('attendance.create') }}">+ Add Attendance</a>
@endif
  @if(in_array(auth()->user()->role, ['admin', 'teacher']))

<form method="GET">

    <!-- Circle -->
    <select name="circle_id">
        <option value="">All Circles</option>
        @foreach($circles as $circle)
            <option value="{{ $circle->id }}"
                {{ request('circle_id') == $circle->id ? 'selected' : '' }}>
                {{ $circle->name }}
            </option>
        @endforeach
    </select>

    <!-- Student -->
    <select name="student_id">
        <option value="">All Students</option>
        @foreach($circleStudents as $cs)
            <option value="{{ $cs->student->id }}"
                {{ request('student_id') == $cs->student->id ? 'selected' : '' }}>
                {{ $cs->student->name }}
            </option>
        @endforeach
    </select>
    
    <button>Filter</button>

</form>

@endif

    <table>
        <thead>
            <tr>
                @if(auth()->user()->role != 'student')
                    <th>Student</th>
                    <th>Circle</th>
                @endif
                <th>Date</th>
                <th>Status</th>
                <th>Notes</th>

                @if(in_array(auth()->user()->role, ['admin', 'teacher']))
                    <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($attendance as $att)
                <tr>
                    @if(auth()->user()->role != 'student')
                        <td>{{ $att->circleStudent->student->name }}</td>
                        <td>{{ $att->circleStudent->circle->name }}</td>
                    @endif
                    <td>{{ $att->date }}</td>
                    <td>{{ $att->status }}</td>
                    <td>{{ $att->notes }}</td>

                    @if (in_array(auth()->user()->role, ['admin', 'teacher']))
                        <td>
                            <a href="{{ route('attendance.edit', $att->id) }}">Edit</a>

                            <form method="POST" action="{{ route('attendance.destroy', $att->id) }}">
                                @csrf
                                @method('DELETE')
                                <button>Delete</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    
    <!-- @foreach($attendance as $att)
        <p>
            {{ $att->circleStudent->student->name }}
            - {{ $att->date }}
            - {{ $att->status }}
                @if (in_array(auth()->user()->role, ['admin', 'teacher']))
            <a href="{{ route('attendance.edit', $att->id) }}">Edit</a>

            <form method="POST" action="{{ route('attendance.destroy', $att->id) }}">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
              @endif
        </p>
    @endforeach -->
</x-app-layout>
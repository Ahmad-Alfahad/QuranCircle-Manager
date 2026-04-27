<x-app-layout>
    <h2>Attendance</h2>
    @if(in_array(auth()->user()->role, ['admin', 'teacher']))
    <a href="{{ route('attendance.create') }}">Add Attendance</a>
@endif
    
    @foreach($attendance as $att)
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
    @endforeach
</x-app-layout>
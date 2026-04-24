<x-app-layout>
    <h2>Attendance</h2>

    <a href="{{ route('attendance.create') }}">Add Attendance</a>

    @foreach($attendance as $att)
        <p>
            {{ $att->circleStudent->student->name }}
            - {{ $att->date }}
            - {{ $att->status }}

            <a href="{{ route('attendance.edit', $att->id) }}">Edit</a>

            <form method="POST" action="{{ route('attendance.destroy', $att->id) }}">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
        </p>
    @endforeach
</x-app-layout>
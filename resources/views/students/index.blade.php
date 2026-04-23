<x-app-layout>
    <h2>Students</h2>

    <a href="{{ route('students.create') }}">Add Student</a>

    @foreach($students as $student)
        <p>
            {{ $student->name }} - {{ $student->email }}

            <a href="{{ route('students.edit', $student->id) }}">Edit</a>

            <form method="POST" action="{{ route('students.destroy', $student->id) }}">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
        </p>
    @endforeach
</x-app-layout>
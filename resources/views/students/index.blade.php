<x-app-layout>
    @section('title', 'Students')
    @section('breadcrumbs') 
    Dashboard / Students / {{ $students->count() }} students
    @endsection
    <h2>Students</h2>

    @if(auth()->user()->role == 'admin')
        <a href="{{ route('students.create') }}">Create Student</a>
    @endif

    <div>Student name - Email</div>
    @foreach($students as $student)
        <p>
            {{ $student->name }} - {{ $student->email }}
            @if(auth()->user()->role == 'admin')
                    <a href="{{ route('students.edit', $student->id) }}">Edit</a>

                <form method="POST" action="{{ route('students.destroy', $student->id) }}">
                    @csrf
                    @method('DELETE')
                    <button>Delete</button>

                </form>
            @endif
        <a href="{{ route('students.show', $student->id) }}">
            View Profile
        </a>
        </p>
    @endforeach

</x-app-layout>
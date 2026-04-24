<x-app-layout>
    <h2>Circle: {{ $circle->name }}</h2>

    <p><strong>Teacher:</strong> {{ $circle->teacher->name ?? '-' }}</p>

    <hr>

    <h3>Students</h3>

    @if($circle->circleStudents->isEmpty())
        <p>No students in this circle</p>
    @endif

    @foreach($circle->circleStudents as $cs)
        <p>
            {{ $cs->student->name }}
            (Joined: {{ $cs->joined_at }})
        </p>
        <form method="POST" action="{{ route('circleStudents.remove', $cs->id) }}">
    @csrf
    @method('DELETE')
    <button>Remove</button>
</form>
    @endforeach
</x-app-layout>
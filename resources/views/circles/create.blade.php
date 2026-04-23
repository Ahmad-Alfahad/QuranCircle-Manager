<x-app-layout>
    <h2>Create Circle</h2>

    <form method="POST" action="{{ route('circles.store') }}">
        @csrf

        <input type="text" name="name" placeholder="Circle Name">

        <select name="teacher_id">
            @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
            @endforeach
        </select>

        <button type="submit">Save</button>
    </form>
</x-app-layout>
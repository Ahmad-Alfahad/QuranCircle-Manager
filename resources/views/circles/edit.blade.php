<x-app-layout>
    <h2>Edit Circle</h2>

    <form method="POST" action="{{ route('circles.update', $circle->id) }}">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $circle->name }}">

        <select name="teacher_id">
            @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}" 
                    {{ $circle->teacher_id == $teacher->id ? 'selected' : '' }}>
                    {{ $teacher->name }}
                </option>
            @endforeach
        </select>

        <button type="submit">Update</button>
    </form>
</x-app-layout>
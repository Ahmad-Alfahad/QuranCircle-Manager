<x-app-layout>
    <h2>Edit Student</h2>

    <form method="POST" action="{{ route('students.update', $student->id) }}">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $student->name }}">
        <input type="email" name="email" value="{{ $student->email }}">

        <button type="submit">Update</button>
    </form>
</x-app-layout>
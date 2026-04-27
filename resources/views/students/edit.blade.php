<x-app-layout>
    <h2>Edit Student</h2>

    <form method="POST" action="{{ route('students.update', $user->id) }}">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $user->name }}">
        <input type="email" name="email" value="{{ $user->email }}">

        <button type="submit">Update</button>
    </form>
</x-app-layout>
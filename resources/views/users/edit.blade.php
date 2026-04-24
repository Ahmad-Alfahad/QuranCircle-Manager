<x-app-layout>
    <h2>Edit User</h2>

    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $user->name }}">
        <input type="email" name="email" value="{{ $user->email }}">
        <input type="password" name="password" placeholder="New Password (optional)">

        <select name="role">
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="teacher" {{ $user->role == 'teacher' ? 'selected' : '' }}>Teacher</option>
            <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Student</option>
        </select>

        <button type="submit">Update</button>
    </form>
</x-app-layout>
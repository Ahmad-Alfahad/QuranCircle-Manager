<x-app-layout>
    <h2>Create User</h2>

    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <input type="text" name="name" placeholder="Name">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">

        <select name="role">
            <option value="admin">Admin</option>
            <option value="teacher">Teacher</option>
            <option value="student">Student</option>
            <option value="user">User</option>
        </select>

        <button type="submit">Save</button>
    </form>
</x-app-layout>
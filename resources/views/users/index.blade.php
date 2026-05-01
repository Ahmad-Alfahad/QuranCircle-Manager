

<x-app-layout>
    @section('title', 'Users')
    @section('breadcrumbs')
    Dashboard / Users
    @endsection
    <x-slot>
        <h2>Users</h2>
    </x-slot>
    <!-- 🔥 Filter -->
    <a href="{{ route('users.index') }}">All</a> |
    <a href="{{ route('users.index', ['role' => 'teacher']) }}">Teachers</a> |
    <a href="{{ route('users.index', ['role' => 'student']) }}">Students</a> |
    <a href="{{ route('users.index', ['role' => 'admin']) }}">Admins</a>
    <a href="{{ route('users.index', ['role' => 'user']) }}">users</a>

    <hr>

    @if($users->isEmpty())
        <p>No users found</p>
    @endif

    @foreach($users as $user)
        <p>
            {{ $user->name }} - {{ $user->email }} - <strong>{{ $user->role }}</strong>
            <a href="{{ route('users.edit', $user->id) }}">Edit</a>
             @if($user->role == 'user')
        <form method="POST" action="{{ route('users.makeStudent', $user->id) }}">
            @csrf

            <select name="circle_id">
                @foreach($circles as $circle)
                    <option value="{{ $circle->id }}">
                        {{ $circle->name }}
                    </option>
                @endforeach
            </select>

            <button>Make Student</button>
        </form>
    @endif

        <form method="POST" action="{{ route('users.destroy', $user->id) }}">
            @csrf
            @method('DELETE')
            <button>Delete</button>
        </form>
           
        </p>
    @endforeach


@if(auth()->user()->role == 'admin')
    <a href="{{ route('users.create') }}">Add User</a>
@endif


</x-app-layout>
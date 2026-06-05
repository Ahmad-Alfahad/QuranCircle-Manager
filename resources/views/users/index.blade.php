<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">
                Users Management
            </h2>

            @if(auth()->user()->role == 'admin')
                <a href="{{ route('users.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                     Add User
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Filters -->
            <div class="bg-white p-4 rounded-lg shadow mb-6">
                <div class="flex flex-wrap gap-2">

                    <a href="{{ route('users.index') }}" class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200">
                        All
                    </a>

                    <a href="{{ route('users.index', ['role' => 'teacher']) }}"
                        class="px-4 py-2 rounded bg-blue-100 text-blue-700 hover:bg-blue-200">
                        Teachers
                    </a>

                    <a href="{{ route('users.index', ['role' => 'student']) }}"
                        class="px-4 py-2 rounded bg-green-100 text-green-700 hover:bg-green-200">
                        Students
                    </a>

                    <a href="{{ route('users.index', ['role' => 'admin']) }}"
                        class="px-4 py-2 rounded bg-red-100 text-red-700 hover:bg-red-200">
                        Admins
                    </a>

                    <a href="{{ route('users.index', ['role' => 'user']) }}"
                        class="px-4 py-2 rounded bg-yellow-100 text-yellow-700 hover:bg-yellow-200">
                        Users
                    </a>

                </div>
            </div>

            @if($users->isEmpty())
                <div class="bg-white rounded-lg shadow p-6 text-center text-gray-500">
                    No users found.
                </div>
            @else

                <div class="bg-white rounded-lg shadow overflow-hidden">

                    <table class="w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="text-left p-4">Name</th>
                                <th class="text-left p-4">Email</th>
                                <th class="text-left p-4">Role</th>
                                <th class="text-center p-4">Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($users as $user)

                                <tr class="border-t hover:bg-gray-50">

                                    <td class="p-4">
                                        {{ $user->name }}
                                    </td>

                                    <td class="p-4">
                                        {{ $user->email }}
                                    </td>

                                    <td class="p-4">

                                        @if($user->role == 'admin')
                                            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm">
                                                Admin
                                            </span>

                                        @elseif($user->role == 'teacher')
                                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm">
                                                Teacher
                                            </span>

                                        @elseif($user->role == 'student')
                                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">
                                                Student
                                            </span>

                                        @else
                                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">
                                                User
                                            </span>
                                        @endif

                                    </td>

                                    <td class="p-4">

                                        <div class="flex flex-wrap gap-2 justify-center">

                                            <a href="{{ route('users.edit', $user->id) }}"
                                                class="bg-indigo-600 text-white px-3 py-2 rounded hover:bg-indigo-700">
                                                Edit
                                            </a>

                                            @if($user->role == 'user')

                                                <form method="POST" action="{{ route('users.makeStudent', $user->id) }}"
                                                    class="flex gap-2">

                                                    @csrf

                                                    <select name="circle_id" class="border rounded px-2 py-1">

                                                        @foreach($circles as $circle)
                                                            <option value="{{ $circle->id }}">
                                                                {{ $circle->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>

                                                    <button class="bg-green-600 text-white px-3 py-2 rounded hover:bg-green-700">
                                                        Make Student
                                                    </button>

                                                </form>

                                            @endif

                                            <form method="POST" action="{{ route('users.destroy', $user->id) }}"
                                                onsubmit="return confirm('Delete this user?')">

                                                @csrf
                                                @method('DELETE')

                                                <button class="bg-red-600 text-white px-3 py-2 rounded hover:bg-red-700">
                                                    Delete
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </div>
    </div>
    ```

</x-app-layout>
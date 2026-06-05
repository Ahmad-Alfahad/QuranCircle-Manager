<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Students
            </h2>

            @if(auth()->user()->role == 'admin')
                <a href="{{ route('students.create') }}"
                   class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                     Create Student
                </a>
            @endif

        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if($students->isEmpty())

                <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">
                    No students found.
                </div>

            @else

                <div class="bg-white rounded-lg shadow overflow-hidden">

                    <table class="min-w-full">

                        <thead class="bg-gray-100">
                            <tr>

                                <th class="p-4 text-left">
                                    Name
                                </th>

                                <th class="p-4 text-left">
                                    Email
                                </th>

                                <th class="p-4 text-left">
                                    Circle
                                </th>

                                <th class="p-4 text-left">
                                    Actions
                                </th>

                            </tr>
                        </thead>

                        <tbody>

                        @foreach($students as $student)

                            <tr class="border-t hover:bg-gray-50">

                                <td class="p-4 font-medium">
                                    {{ $student->name }}
                                </td>

                                <td class="p-4">
                                    {{ $student->email }}
                                </td>

                                <td class="p-4">
                                    {{ $student->circleStudents->first()?->circle->name ?? 'N/A' }}
                                </td>

                                <td class="p-4">

                                    <div class="flex gap-2 flex-wrap">

                                        <a href="{{ route('students.show', $student) }}"
                                           class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                                            View
                                        </a>

                                        @if(auth()->user()->role == 'admin')

                                            <a href="{{ route('students.edit', $student) }}"
                                               class="px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                                Edit
                                            </a>

                                            <form method="POST"
                                                  action="{{ route('students.destroy', $student) }}">
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    onclick="return confirm('Delete this student?')"
                                                    class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                                    Delete
                                                </button>
                                            </form>

                                        @endif

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

</x-app-layout>
<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Attendance
            </h2>

            @if(in_array(auth()->user()->role, ['admin', 'teacher']))
                <a href="{{ route('attendance.create') }}"
                   class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                    Create Attendance
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(in_array(auth()->user()->role, ['admin', 'teacher']))

                <div class="bg-white rounded-lg shadow p-4 mb-6">

                    <form method="GET" class="grid md:grid-cols-3 gap-4">

                        <!-- Circle -->
                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Circle
                            </label>

                            <select
                                name="circle_id"
                                class="w-full border rounded-lg p-2"
                            >
                                <option value="">All Circles</option>

                                @foreach($circles as $circle)
                                    <option
                                        value="{{ $circle->id }}"
                                        {{ request('circle_id') == $circle->id ? 'selected' : '' }}
                                    >
                                        {{ $circle->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Student -->
                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Student
                            </label>

                            <select
                                name="student_id"
                                class="w-full border rounded-lg p-2"
                            >
                                <option value="">All Students</option>

                                @foreach($circleStudents->unique('student_id') as $cs)
                                    <option
                                        value="{{ $cs->student->id }}"
                                        {{ request('student_id') == $cs->student->id ? 'selected' : '' }}
                                    >
                                        {{ $cs->student->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-end gap-2">

                            <button
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
                            >
                                Filter
                            </button>

                            <a
                                href="{{ route('attendance.index') }}"
                                class="bg-gray-200 px-4 py-2 rounded-lg hover:bg-gray-300"
                            >
                                Reset
                            </a>

                        </div>

                    </form>

                </div>

            @endif

            @if($attendance->isEmpty())

                <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">
                    No attendance records found.
                </div>

            @else

                <div class="bg-white rounded-lg shadow overflow-hidden">

                    <table class="min-w-full">

                        <thead class="bg-gray-100">
                            <tr>

                                @if(auth()->user()->role != 'student')
                                    <th class="p-4 text-left">Student</th>
                                    <th class="p-4 text-left">Circle</th>
                                @endif

                                <th class="p-4 text-left">Date</th>
                                <th class="p-4 text-left">Status</th>
                                <th class="p-4 text-left">Notes</th>

                                @if(in_array(auth()->user()->role, ['admin', 'teacher']))
                                    <th class="p-4 text-left">Actions</th>
                                @endif

                            </tr>
                        </thead>

                        <tbody>

                        @foreach($attendance as $att)

                            <tr class="border-t hover:bg-gray-50">

                                @if(auth()->user()->role != 'student')

                                    <td class="p-4">
                                        {{ $att->circleStudent->student->name }}
                                    </td>

                                    <td class="p-4">
                                        {{ $att->circleStudent->circle->name }}
                                    </td>

                                @endif

                                <td class="p-4">
                                    {{ \Carbon\Carbon::parse($att->date)->format('Y-m-d') }}
                                </td>

                                <td class="p-4">

                                    @if($att->status == 'present')
                                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs">
                                            Present
                                        </span>

                                    @elseif($att->status == 'absent')
                                        <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs">
                                            Absent
                                        </span>

                                    @elseif($att->status == 'late')
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs">
                                            Late
                                        </span>

                                    @else
                                        <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-xs">
                                            {{ ucfirst($att->status) }}
                                        </span>
                                    @endif

                                </td>

                                <td class="p-4">
                                    {{ $att->notes ?: '-' }}
                                </td>

                                @if(in_array(auth()->user()->role, ['admin', 'teacher']))

                                    <td class="p-4">

                                        <div class="flex gap-2">

                                            <a
                                                href="{{ route('attendance.edit', $att->id) }}"
                                                class="px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700"
                                            >
                                                Edit
                                            </a>

                                            <form
                                                method="POST"
                                                action="{{ route('attendance.destroy', $att->id) }}"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    onclick="return confirm('Delete this attendance record?')"
                                                    class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700"
                                                >
                                                    Delete
                                                </button>
                                            </form>

                                        </div>

                                    </td>

                                @endif

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </div>
    </div>

</x-app-layout>
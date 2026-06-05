<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Circle: {{ $circle->name }}
            </h2>

            <a href="{{ route('circles.index') }}"
               class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                ← Back
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Circle Information -->
            <div class="bg-white shadow rounded-lg p-6 mb-6">

                <h3 class="text-lg font-semibold mb-4">
                    Circle Information
                </h3>

                <div class="grid md:grid-cols-2 gap-4">

                    <div>
                        <span class="font-medium">Name:</span>
                        {{ $circle->name }}
                    </div>

                    <div>
                        <span class="font-medium">Teacher:</span>
                        {{ $circle->teacher->name ?? '-' }}
                    </div>

                    <div>
                        <span class="font-medium">Start Time:</span>
                        {{ $circle->start_time ?? '-' }}
                    </div>

                    <div>
                        <span class="font-medium">End Time:</span>
                        {{ $circle->end_time ?? '-' }}
                    </div>

                    <div class="md:col-span-2">
                        <span class="font-medium">Description:</span>
                        {{ $circle->description ?: 'No description available' }}
                    </div>

                    <div>
                        <span class="font-medium">Students Count:</span>
                        {{ $circle->circleStudents->count() }}
                    </div>

                </div>

            </div>

            <!-- Quick Actions -->
            <div class="bg-white shadow rounded-lg p-6 mb-6">

                <h3 class="text-lg font-semibold mb-4">
                    Quick Actions
                </h3>

                <div class="flex flex-wrap gap-3">

                    <a href="{{ route('records.index', ['circle_id' => $circle->id]) }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Records
                    </a>

                    <a href="{{ route('attendance.index', ['circle_id' => $circle->id]) }}"
                       class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Attendance
                    </a>

                    @if(auth()->user()->role == 'admin')
                        <a href="{{ route('circles.edit', $circle) }}"
                           class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                            Edit Circle
                        </a>
                    @endif

                </div>

            </div>

            <!-- Students -->
            <div class="bg-white shadow rounded-lg overflow-hidden">

                <div class="px-6 py-4 border-b">
                    <h3 class="font-semibold text-lg">
                        Students
                    </h3>
                </div>

                @if($circle->circleStudents->isEmpty())

                    <div class="p-8 text-center text-gray-500">
                        No students assigned to this circle.
                    </div>

                @else

                    <table class="min-w-full">

                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-4 text-left">
                                    Student
                                </th>

                                <th class="p-4 text-left">
                                    Joined At
                                </th>

                                @if(auth()->user()->role == 'admin')
                                    <th class="p-4 text-left">
                                        Actions
                                    </th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>

                        @foreach($circle->circleStudents as $cs)

                            <tr class="border-t hover:bg-gray-50">

                                <td class="p-4">
                                    {{ $cs->student->name }}
                                </td>

                                <td class="p-4">
                                    {{ \Carbon\Carbon::parse($cs->joined_at)->format('Y-m-d') }}
                                </td>

                                @if(auth()->user()->role == 'admin')

                                    <td class="p-4">

                                        <form method="POST"
                                              action="{{ route('circleStudents.remove', $cs->id) }}">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                onclick="return confirm('Remove student from circle?')"
                                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                                Remove
                                            </button>

                                        </form>

                                    </td>

                                @endif

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                @endif

            </div>

        </div>
    </div>

</x-app-layout>
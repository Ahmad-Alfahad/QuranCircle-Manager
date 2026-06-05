<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>

            @if(auth()->user()->role === 'admin')
                <div class="flex gap-2">

                    <a href="{{ route('students.index') }}"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                        Students
                    </a>

                    <a href="{{ route('circles.index') }}"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                        Circles
                    </a>

                </div>
            @endif

        </div>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Statistics -->

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

                @foreach($stats as $key => $value)

                    <div class="bg-white rounded-lg shadow p-6">

                        <div class="text-sm text-gray-500">
                            {{ ucfirst(str_replace('_', ' ', $key)) }}
                        </div>

                        <div class="text-3xl font-bold mt-2">
                            {{ $value }}
                        </div>

                    </div>

                @endforeach

            </div>

            <!-- Recent Records -->

            <div class="bg-white rounded-lg shadow overflow-hidden mb-6">

                <div class="px-6 py-4 border-b">
                    <h3 class="font-semibold text-lg">
                        Recent Records
                    </h3>
                </div>

                <table class="min-w-full">

                    <thead class="bg-gray-100">

                        <tr>
                            <th class="p-3 text-left">Student</th>
                            <th class="p-3 text-left">Surah</th>
                            <th class="p-3 text-left">Type</th>
                            <th class="p-3 text-left">Grade</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($recentRecords as $record)

                            <tr class="border-t hover:bg-gray-50">

                                <td class="p-3">
                                    {{ $record->circleStudent->student->name ?? '-' }}
                                </td>

                                <td class="p-3">
                                    {{ $record->surah->name ?? '-' }}
                                </td>

                                <td class="p-3">
                                    {{ ucfirst($record->type) }}
                                </td>

                                <td class="p-3">
                                    {{ $record->grade }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="text-center p-6 text-gray-500">
                                    No records found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- Recent Attendance -->

            <div class="bg-white rounded-lg shadow overflow-hidden">

                <div class="px-6 py-4 border-b">
                    <h3 class="font-semibold text-lg">
                        Recent Attendance
                    </h3>
                </div>

                <table class="min-w-full">

                    <thead class="bg-gray-100">

                        <tr>
                            <th class="p-3 text-left">Student</th>
                            <th class="p-3 text-left">Date</th>
                            <th class="p-3 text-left">Status</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($recentAttendance as $attendance)

                            <tr class="border-t hover:bg-gray-50">

                                <td class="p-3">
                                    {{ $attendance->circleStudent->student->name ?? '-' }}
                                </td>

                                <td class="p-3">
                                    {{ $attendance->date }}
                                </td>

                                <td class="p-3">

                                    @if($attendance->status === 'present')
                                        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">
                                            Present
                                        </span>

                                    @elseif($attendance->status === 'absent')
                                        <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">
                                            Absent
                                        </span>

                                    @else
                                        <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">
                                            Excused
                                        </span>
                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="3" class="text-center p-6 text-gray-500">
                                    No attendance records found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>
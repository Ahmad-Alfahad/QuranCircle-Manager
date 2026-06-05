<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Student Details
            </h2>

            <a href="{{ route('students.index') }}"
               class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                ← Back
            </a>

        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Student Information -->
            <div class="bg-white shadow rounded-lg p-6 mb-6">

                <h3 class="text-lg font-semibold mb-4">
                    Student Information
                </h3>

                <div class="grid md:grid-cols-2 gap-4">

                    <div>
                        <span class="font-medium">Name:</span>
                        {{ $user->name }}
                    </div>

                    <div>
                        <span class="font-medium">Email:</span>
                        {{ $user->email }}
                    </div>

                    <div>
                        <span class="font-medium">Role:</span>
                        {{ ucfirst($user->role) }}
                    </div>

                </div>

            </div>

            <!-- Quick Actions -->
            <div class="bg-white shadow rounded-lg p-6 mb-6">

                <h3 class="text-lg font-semibold mb-4">
                    Quick Actions
                </h3>

                <div class="flex flex-wrap gap-3">

                    <a href="{{ route('students.records', $user) }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        View Records
                    </a>

                    <a href="{{ route('students.attendance', $user) }}"
                       class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        View Attendance
                    </a>

                    @if(auth()->user()->role == 'admin')
                        <a href="{{ route('students.edit', $user) }}"
                           class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                            Edit Student
                        </a>
                    @endif

                </div>

            </div>

            <!-- Related Circles -->
            <div class="bg-white shadow rounded-lg p-6 mb-6">

                <h3 class="text-lg font-semibold mb-4">
                    Related Circles
                </h3>

                <div class="flex flex-wrap gap-2">

                    @forelse($circleStudents as $cs)

                        <span
                            class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full">
                            {{ $cs->circle->name }}
                        </span>

                    @empty

                        <span class="text-gray-500">
                            No circles assigned.
                        </span>

                    @endforelse

                </div>

            </div>

            <!-- Statistics -->
            @php
                $present = $attendance->where('status', 'present')->count();
                $total = $attendance->count();
                $percentage = $total ? round(($present / $total) * 100) : 0;
            @endphp

            <div class="grid md:grid-cols-3 gap-4 mb-6">

                <div class="bg-white shadow rounded-lg p-6 text-center">

                    <div class="text-gray-500 text-sm">
                        Total Records
                    </div>

                    <div class="text-3xl font-bold mt-2">
                        {{ $records->count() }}
                    </div>

                </div>

                <div class="bg-white shadow rounded-lg p-6 text-center">

                    <div class="text-gray-500 text-sm">
                        Total Attendance
                    </div>

                    <div class="text-3xl font-bold mt-2">
                        {{ $attendance->count() }}
                    </div>

                </div>

                <div class="bg-white shadow rounded-lg p-6 text-center">

                    <div class="text-gray-500 text-sm">
                        Attendance Rate
                    </div>

                    <div class="text-3xl font-bold mt-2">
                        {{ $percentage }}%
                    </div>

                </div>

            </div>

            <!-- Latest Record -->
            @php
                $last = $records->first();
            @endphp

            @if($last)

                <div class="bg-white shadow rounded-lg p-6 mb-6">

                    <h3 class="text-lg font-semibold mb-4">
                        Latest Record
                    </h3>

                    <div class="grid md:grid-cols-2 gap-4">

                        <div>
                            <span class="font-medium">Surah:</span>
                            {{ $last->surah->name }}
                        </div>

                        <div>
                            <span class="font-medium">Method:</span>
                            {{ ucfirst($last->method) }}
                        </div>

                        <div>
                            <span class="font-medium">Range:</span>
                            {{ $last->from }} → {{ $last->to }}
                        </div>

                        <div>
                            <span class="font-medium">Type:</span>
                            {{ ucfirst($last->type) }}
                        </div>

                        <div>
                            <span class="font-medium">Grade:</span>
                            {{ $last->grade ?? '-' }}
                        </div>

                        <div>
                            <span class="font-medium">Date:</span>
                            {{ $last->recorded_at ?? $last->date }}
                        </div>

                    </div>

                </div>

            @endif

        </div>
    </div>

</x-app-layout>
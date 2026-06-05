<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Attendance For: {{ $user->name }}
            </h2>

            <a href="{{ route('students.show', $user) }}"
                class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                ← Back
            </a>

        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @php
                $present = $attendance->where('status', 'present')->count();
                $absent = $attendance->where('status', 'absent')->count();
                $excused = $attendance->where('status', 'excused')->count();
                $total = $attendance->count();

                $rate = $total ? round(($present / $total) * 100) : 0;
            @endphp

            <!-- Summary -->

            <div class="bg-white shadow rounded-lg p-6 mb-6">

                <h3 class="text-lg font-semibold mb-4">
                    Attendance Summary
                </h3>

                <div class="grid md:grid-cols-4 gap-4">

                    <div class="text-center">
                        <div class="text-gray-500 text-sm">
                            Total Records
                        </div>

                        <div class="font-bold text-2xl">
                            {{ $total }}
                        </div>
                    </div>

                    <div class="text-center">
                        <div class="text-gray-500 text-sm">
                            Present
                        </div>

                        <div class="font-bold text-2xl text-green-600">
                            {{ $present }}
                        </div>
                    </div>

                    <div class="text-center">
                        <div class="text-gray-500 text-sm">
                            Absent
                        </div>

                        <div class="font-bold text-2xl text-red-600">
                            {{ $absent }}
                        </div>
                    </div>

                    <div class="text-center">
                        <div class="text-gray-500 text-sm">
                            Attendance Rate
                        </div>

                        <div class="font-bold text-2xl">
                            {{ $rate }}%
                        </div>
                    </div>

                </div>

            </div>

            @if($attendance->isEmpty())

                <div class="bg-white shadow rounded-lg p-8 text-center text-gray-500">
                    No attendance records found for {{ $user->name }}.
                </div>

            @else

                <div class="bg-white shadow rounded-lg overflow-hidden">

                    <table class="min-w-full">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="p-4 text-left">
                                    Date
                                </th>

                                <th class="p-4 text-left">
                                    Status
                                </th>

                                <th class="p-4 text-left">
                                    Notes
                                </th>

                                @if(in_array(auth()->user()->role, ['admin', 'teacher']))
                                    <th class="p-4 text-left">
                                        Actions
                                    </th>
                                @endif

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($attendance as $att)

                                <tr class="border-t hover:bg-gray-50">

                                    <td class="p-4">
                                        {{ $att->date }}
                                    </td>

                                    <td class="p-4">

                                        @if($att->status == 'present')
                                            <span class="px-2 py-1 rounded bg-green-100 text-green-700 text-xs">
                                                Present
                                            </span>

                                        @elseif($att->status == 'absent')
                                            <span class="px-2 py-1 rounded bg-red-100 text-red-700 text-xs">
                                                Absent
                                            </span>

                                        @else
                                            <span class="px-2 py-1 rounded bg-yellow-100 text-yellow-700 text-xs">
                                                Excused
                                            </span>
                                        @endif

                                    </td>

                                    <td class="p-4">
                                        {{ $att->notes ?: '-' }}
                                    </td>

                                    @if(in_array(auth()->user()->role, ['admin', 'teacher']))

                                        <td class="p-4">

                                            <div class="flex gap-2">

                                                <a href="{{ route('attendance.edit', $att) }}?redirect_to={{ url()->current() }}"
                                                    class="px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                                    Edit
                                                </a>

                                                <form method="POST"
                                                    action="{{ route('attendance.destroy', $att) }}">

                                                    @csrf
                                                    @method('DELETE')

                                                    <input
                                                        type="hidden"
                                                        name="redirect_to"
                                                        value="{{ url()->current() }}">

                                                    <button
                                                        onclick="return confirm('Delete this attendance record?')"
                                                        class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
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
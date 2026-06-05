<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Records
            </h2>

            @if(in_array(auth()->user()->role, ['admin', 'teacher']))
                <a href="{{ route('records.create') }}"
                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                    Create Record
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Filters --}}
            <div class="bg-white rounded-lg shadow p-4 mb-6">

                <form method="GET" class="grid md:grid-cols-4 gap-4">
                    @if(in_array(auth()->user()->role, ['admin', 'teacher']))
                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Circle
                            </label>

                            <select name="circle_id" class="w-full border rounded-lg p-2">
                                <option value="">All Circles</option>

                                @foreach($circles as $circle)
                                    <option value="{{ $circle->id }}" {{ request('circle_id') == $circle->id ? 'selected' : '' }}>
                                        {{ $circle->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Student
                            </label>

                            <select name="student_id" class="w-full border rounded-lg p-2">
                                <option value="">All Students</option>

                                @foreach($circleStudents as $cs)
                                    <option value="{{ $cs->id }}" {{ old('circle_student_id', $record->circle_student_id ?? '') == $cs->id ? 'selected' : '' }}>
                                        {{ $cs->student->name }}
                                        ({{ $cs->circle->name }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Surah
                        </label>

                        <select name="surah_id" class="w-full border rounded-lg p-2">
                            <option value="">All Surahs</option>

                            @foreach($surahs as $surah)
                                <option value="{{ $surah->id }}" {{ request('surah_id') == $surah->id ? 'selected' : '' }}>
                                    {{ $surah->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-end gap-2">

                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            Filter
                        </button>

                        <a href="{{ route('records.index') }}"
                            class="bg-gray-200 px-4 py-2 rounded-lg hover:bg-gray-300">
                            Reset
                        </a>

                    </div>

                </form>

            </div>

            {{-- Records Table --}}
            @if($records->isEmpty())

                <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">
                    No records found.
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

                                <th class="p-4 text-left">Surah</th>
                                <th class="p-4 text-left">Range</th>
                                <th class="p-4 text-left">Type</th>
                                <th class="p-4 text-left">Grade</th>
                                <th class="p-4 text-left">Date</th>

                                @if(in_array(auth()->user()->role, ['admin', 'teacher']))
                                    <th class="p-4 text-left">Actions</th>
                                @endif

                            </tr>
                        </thead>

                        <tbody>

                            @foreach($records as $record)

                                <tr class="border-t hover:bg-gray-50">

                                    @if(auth()->user()->role != 'student')
                                        <td class="p-4">
                                            {{ $record->circleStudent->student->name }}
                                        </td>

                                        <td class="p-4">
                                            {{ $record->circleStudent->circle->name }}
                                        </td>
                                    @endif

                                    <td class="p-4">
                                        {{ $record->surah->name }}
                                    </td>

                                    <td class="p-4">
                                        {{ $record->from }}
                                        →
                                        {{ $record->to }}

                                        <span class="text-gray-500">
                                            ({{ $record->method }})
                                        </span>
                                    </td>

                                    <td class="p-4">

                                        @if($record->type == 'hifz')
                                            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">
                                                Hifz
                                            </span>
                                        @else
                                            <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded-full text-xs">
                                                Review
                                            </span>
                                        @endif

                                    </td>

                                    <td class="p-4">

                                        @if($record->grade >= 90)
                                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs">
                                                {{ $record->grade }}
                                            </span>

                                        @elseif($record->grade >= 70)
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs">
                                                {{ $record->grade }}
                                            </span>

                                        @else
                                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs">
                                                {{ $record->grade }}
                                            </span>
                                        @endif

                                    </td>

                                    <td class="p-4">
                                        {{ \Carbon\Carbon::parse($record->recorded_at)->format('Y-m-d') }}
                                    </td>

                                    @if(in_array(auth()->user()->role, ['admin', 'teacher']))

                                        <td class="p-4">

                                            <div class="flex gap-2">

                                                <a href="{{ route('records.edit', $record->id) }}"
                                                    class="px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                                    Edit
                                                </a>

                                                @if(auth()->user()->role == 'admin')

                                                    <form method="POST" action="{{ route('records.destroy', $record->id) }}">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button onclick="return confirm('Delete this record?')"
                                                            class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                                            Delete
                                                        </button>
                                                    </form>

                                                @endif

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
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Records') }}
        </h2>
    </x-slot>
    @section('title', 'Records')
    @section('breadcrumbs')
        Dashboard / Records
    @endsection
    @if(in_array(auth()->user()->role, ['admin', 'teacher']))
        <a href="{{ route('records.create') }}"
           class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Create
        </a>
    @endif
    filter by circle
    <form action="" method="GET">
        filter by circle
        <select name="circle_id">
            <option value="">All Circles</option>
            @foreach($circles as $circle)
                <option value="{{ $circle->id }}" {{ request('circle_id') == $circle->id ? 'selected' : '' }}>
                    {{ $circle->name }}
                </option>
            @endforeach
        </select>
        @if (in_array(auth()->user()->role, ['admin', 'teacher']))
            filter by student
            <select name="student_id" id="">
                <option value="">All Students</option>
                @foreach($circleStudents->pluck('student')->unique() as $student)
                    <option value="{{ $student->id }}" {{ request('student_id') == $student->id ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
        @endif

        filter by surah
        <select name="surah_id" id="">
            <option value="">All Surahs</option>
            @foreach($surahs as $surah)
                <option value="{{ $surah->id }}" {{ request('surah_id') == $surah->id ? 'selected' : '' }}>
                    {{ $surah->name }}
                </option>
            @endforeach
        </select>
        <button>Filter</button>
    </form>


    @if ($records->isEmpty())
        <p>No records found.</p>
    @else
        <div class="bg-white shadow rounded">
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>

                        @if(auth()->user()->role != 'student')
                            <th class="p-2 text-left">Student</th>
                            <th class="p-2 text-left">Circle</th>
                        @endif

                        <th class="p-2 text-left">Surah</th>
                        <th class="p-2 text-left">Range</th>
                        <th class="p-2 text-left">Type</th>
                        <th class="p-2 text-left">Grade</th>
                        <th class="p-2 text-left">Date</th>

                        @if(in_array(auth()->user()->role, ['admin', 'teacher']))
                            <th class="p-2 text-left">Actions</th>
                        @endif

                    </tr>
                </thead>

                <tbody>
                    @foreach($records as $record)
                        <tr class="border-t hover:bg-gray-50">

                            @if(auth()->user()->role != 'student')
                                <td class="p-2">{{ $record->circleStudent->student->name }}</td>
                                <td class="p-2">{{ $record->circleStudent->circle->name }}</td>
                            @endif

                            <td class="p-2">{{ $record->surah->name }}</td>

                            <td class="p-2">

                                {{ $record->from }} → {{ $record->to }}

                            </td>

                            <td class="p-2">{{ $record->type }}</td>
                            <td class="p-2">{{ $record->grade }}</td>
                            <td class="p-2">{{ $record->recorded_at }}</td>


                            @if(in_array(auth()->user()->role, ['admin', 'teacher']))
                                <td>
                                    <a href="{{ route('records.edit', $record->id) }} " class="text-gray-500 text-sm mb-3 inline-block">Edit</a>

                                    @if(auth()->user()->role == 'admin')
                                        <form method="POST" action="{{ route('records.destroy', $record->id) }}" class="text-gray-500 text-sm mb-3 inline-block ">
                                            @csrf
                                            @method('DELETE')
                                            <button>| Delete</button>
                                        </form>
                                    @endif
                                </td>
                            @endif

                        </tr>
                    @endforeach
                </tbody>
            </table>
    @endif
    </div>
</x-app-layout>
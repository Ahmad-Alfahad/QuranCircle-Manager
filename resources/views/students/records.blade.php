<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Records For: {{ $user->name }}
            </h2>

            <a href="{{ route('students.show', $user) }}"
               class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                ← Back
            </a>

        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Summary -->
            <div class="bg-white shadow rounded-lg p-6 mb-6">

                <h3 class="text-lg font-semibold mb-4">
                    Summary
                </h3>

                <div class="grid md:grid-cols-3 gap-4">

                    <div class="text-center">
                        <div class="text-gray-500 text-sm">
                            Student
                        </div>

                        <div class="font-bold text-lg">
                            {{ $user->name }}
                        </div>
                    </div>

                    <div class="text-center">
                        <div class="text-gray-500 text-sm">
                            Total Records
                        </div>

                        <div class="font-bold text-2xl">
                            {{ $records->count() }}
                        </div>
                    </div>

                    <div class="text-center">
                        <div class="text-gray-500 text-sm">
                            Average Grade
                        </div>

                        <div class="font-bold text-2xl">
                            {{ $records->count() ? round($records->avg('grade'), 1) : 0 }}
                        </div>
                    </div>

                </div>

            </div>

            @if($records->isEmpty())

                <div class="bg-white shadow rounded-lg p-8 text-center text-gray-500">
                    No records found for {{ $user->name }}.
                </div>

            @else

                <div class="bg-white shadow rounded-lg overflow-hidden">

                    <table class="min-w-full">

                        <thead class="bg-gray-100">
                            <tr>

                                <th class="p-4 text-left">
                                    Circle
                                </th>

                                <th class="p-4 text-left">
                                    Surah
                                </th>

                                <th class="p-4 text-left">
                                    Range
                                </th>

                                <th class="p-4 text-left">
                                    Type
                                </th>

                                <th class="p-4 text-left">
                                    Grade
                                </th>

                                <th class="p-4 text-left">
                                    Date
                                </th>

                                @if(in_array(auth()->user()->role, ['admin', 'teacher']))
                                    <th class="p-4 text-left">
                                        Actions
                                    </th>
                                @endif

                            </tr>
                        </thead>

                        <tbody>

                        @foreach($records as $record)

                            <tr class="border-t hover:bg-gray-50">

                                <td class="p-4">
                                    {{ $record->circleStudent->circle->name }}
                                </td>

                                <td class="p-4">
                                    {{ $record->surah->name }}
                                </td>

                                <td class="p-4">
                                    {{ $record->from }} → {{ $record->to }}
                                </td>

                                <td class="p-4">
                                    {{ ucfirst($record->type) }}
                                </td>

                                <td class="p-4">
                                    {{ $record->grade }}
                                </td>

                                <td class="p-4">
                                    {{ $record->recorded_at }}
                                </td>

                                @if(in_array(auth()->user()->role, ['admin', 'teacher']))

                                    <td class="p-4">

                                        <div class="flex gap-2">

                                            <a href="{{ route('records.edit', $record) }}?redirect_to={{ url()->current() }}"
                                               class="px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                                Edit
                                            </a>

                                            <form method="POST"
                                                  action="{{ route('records.destroy', $record) }}">
                                                @csrf
                                                @method('DELETE')

                                                <input type="hidden"
                                                       name="redirect_to"
                                                       value="{{ url()->current() }}">

                                                <button
                                                    onclick="return confirm('Delete this record?')"
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
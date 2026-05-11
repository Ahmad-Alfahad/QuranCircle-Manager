<x-app-layout>
     <x-slot name="header">
        <h4 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Records For Student :')   }}{{ $user->name }}
    </x-slot>
    <div class="m-6">
        @if ($records->isEmpty())
            <p>No records found for {{ $user->name }}.</p>
        @else

            <div class="bg-white shadow rounded">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 text-left">Circle</th>
                            <th class="p-2 text-left">Surah</th>
                            <th class="p-2 text-left">Range</th>
                            <th class="p-2 text-left">Type</th>
                            <th class="p-2 text-left">Grade</th>
                            <th class="p-2 text-left">Date</th>
                            @if (in_array(auth()->user()->role, ['admin', 'teacher']))
                                <th class="p-2 text-left">Actions</th>

                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                            <tr class="border-t hover:bg-gray-100">
                                <td class="p-1">{{ $record->circleStudent->circle->name }}</td>
                                <td class="p-1">{{ $record->surah->name }}</td>
                                <td class="p-1">{{ $record->from }} - {{ $record->to }}</td>
                                <td class="p-1">{{ $record->type }}</td>
                                <td class="p-1">{{ $record->grade }}</td>
                                <td class="p-1">{{ $record->recorded_at }}</td>
                                @if (in_array(auth()->user()->role, ['admin', 'teacher']))
                                    <td class="p-1">
                                        <a href="{{ route('records.edit', $record->id) }}?redirect_to={{ url()->current() }}"
                                            class="text-gray-500 text-sm mb-3 inline-block">Edit</a>

                                        <form method="POST" action="{{ route('records.destroy', $record->id)}}"
                                            class="text-gray-500 text-sm mb-3 inline-block">
                                            <input type="hidden" name="redirect_to" value="{{ request('redirect_to') }}">

                                            @csrf
                                            @method('DELETE')
                                            <button> | Delete</button>
                                        </form>
                                    </td>

                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <a href="{{ route('students.show', $user->id) }}" class="text-gray-500 text-sm mb-3 inline-block">
            ← Back
        </a>
    </div>
</x-app-layout>
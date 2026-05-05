<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Attendance For Student :')   }}{{ $user->name }}
    </x-slot>
    <div class="m-6">
    @if($attendance->isEmpty())
        <p>No attendance records found for {{ $user->name }}.</p>
    @else
        
        <div  class="bg-white shadow rounded">
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <th class="p-2 text-left">Date</th>
                    <th class="p-2 text-left">Status</th>
                    <th class="p-2 text-left">Notes</th>
                    @if (in_array(auth()->user()->role, ['admin', 'teacher']))
                        <th class="p-2 text-left">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($attendance as $att)
                    <tr class="border-t hover:bg-gray-100">
                        <td class="p-1">{{ $att->date }}</td>
                        <td class="p-1">{{ $att->status }}</td>
                        <td class="p-1">{{ $att->notes }}</td>
                        @if (in_array(auth()->user()->role, ['admin', 'teacher']))
                            <td class="p-1">
                                <a href="{{ route('attendance.edit', $att->id) }}?redirect_to={{ url()->current() }}"
                                class="text-gray-500 text-sm mb-3 inline-block">Edit</a>

                                <form method="POST" action="{{ route('attendance.destroy', $att->id) }}"
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
    @endif
    <a href="{{ route('students.show', $user->id) }}" class="text-gray-500 text-sm mb-3 inline-block">
        ← Back
    </a>
    </div>
</x-app-layout>
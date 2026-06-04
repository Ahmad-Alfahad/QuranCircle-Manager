<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Circle :') }} {{ $circle->name }}
        </h2>
    </x-slot>
    <div class="m-4">
        <strong>Teacher Name : {{ $circle->teacher->name ?? '-' }} </strong>
    </div>

    <div class="m-6">
        @if($circle->circleStudents->isEmpty())
            <p>No students in this circle</p>
        @else

            <div class="bg-white shadow rounded">
                <strong> All Students</strong>
                <table class="w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 text-left">Name</th>
                            <th class="p-2 text-left">Joined</th>
                            @if(auth()->user()->role == 'admin')
                                <th class="p-2 text-left">Actions</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($circle->circleStudents as $cs)
                            <tr class="border-t hover:bg-gray-100">
                                <td class="p-1">{{ $cs->student->name }}</td>
                                <td class="p-1">{{ $cs->joined_at }}</td>

                                @if(auth()->user()->role == 'admin')
                                    <td class="p-1">
                                        <form action="{{ route('circleStudents.remove', $cs->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-gray-500 text-sm mb-3 inline-block ml-2">Delete</button>
                                        </form>

                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <a href="{{ route('circles.index') }}" class="text-gray-500 text-sm mb-3 inline-block">
            ← Back
        </a>
    </div>

</x-app-layout>
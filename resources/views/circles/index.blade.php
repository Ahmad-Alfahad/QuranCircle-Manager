<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Circles') }}
            </h2>
            @if(auth()->user()->role == 'admin')
                <button><a href="{{ route('circles.create') }}"
                        class="bg-green-500 text-white p-2 rounded hover:bg-green-600">
                        Create Circle
                    </a>
                </button>
            @endif
        </div>
    </x-slot>

    <div class="m-6">
        @if ($circles->isEmpty())
            <p>No circles found.</p>
        @else
            <div class="bg-white shadow rounded">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 text-left">Name</th>
                            @if(auth()->user()->role == 'admin')
                                <th class="p-2 text-left">Teacher</th>

                                <th class="p-2 text-left">Actions</th>
                            @endif
                            <th class="p-2 text-left">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($circles as $circle)
                            <tr class="border-t hover:bg-gray-100">
                                <td class="p-1">{{ $circle->name }}</td>

                                @if(auth()->user()->role == 'admin')
                                    <td class="p-1">{{ $circle->teacher->name ?? '-' }}</td>

                                    <td class="p-1">

                                        <a href="{{ route('circles.edit', $circle->id) }}"
                                          class="text-gray-500 text-sm mb-3 inline-block ml-2" >Edit</a>

                                        <form action="{{ route('circles.destroy', $circle->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"  class="text-gray-500 text-sm mb-3 inline-block ml-2" >Delete</button>
                                        </form>

                                    </td>
                                @endif
                                <td class="p-1"><a href="{{ route('circles.show', $circle->id) }}"
                                 class="text-gray-500 text-sm mb-3 inline-block ml-2">
                                        View
                                    </a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
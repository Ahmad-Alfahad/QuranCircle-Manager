<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Circles
            </h2>

            @if(auth()->user()->role == 'admin')
                <a href="{{ route('circles.create') }}"
                   class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                     Create Circle
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if($circles->isEmpty())

                <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">
                    No circles found.
                </div>

            @else

                <div class="bg-white rounded-lg shadow overflow-hidden">

                    <table class="min-w-full">

                        <thead class="bg-gray-100">
                            <tr>

                                <th class="p-4 text-left">
                                    Circle Name
                                </th>

                                @if(auth()->user()->role == 'admin')
                                    <th class="p-4 text-left">
                                        Teacher
                                    </th>
                                @endif

                                <th class="p-4 text-left">
                                    Details
                                </th>

                                @if(auth()->user()->role == 'admin')
                                    <th class="p-4 text-left">
                                        Actions
                                    </th>
                                @endif

                            </tr>
                        </thead>

                        <tbody>

                        @foreach($circles as $circle)

                            <tr class="border-t hover:bg-gray-50">

                                <td class="p-4 font-medium">
                                    {{ $circle->name }}
                                </td>

                                @if(auth()->user()->role == 'admin')
                                    <td class="p-4">
                                        {{ $circle->teacher->name ?? '-' }}
                                    </td>
                                @endif

                                <td class="p-4">

                                    <a href="{{ route('circles.show', $circle) }}"
                                       class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                                        View
                                    </a>

                                </td>

                                @if(auth()->user()->role == 'admin')

                                    <td class="p-4">

                                        <div class="flex gap-2">

                                            <a href="{{ route('circles.edit', $circle) }}"
                                               class="px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                                Edit
                                            </a>

                                            <form method="POST"
                                                  action="{{ route('circles.destroy', $circle) }}">
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    onclick="return confirm('Delete this circle?')"
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
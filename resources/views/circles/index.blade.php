<x-app-layout>
        <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Circles') }}
        </h2>
    </x-slot>
    @section('title', 'Circles')
    @section('breadcrumbs')
    Dashboard / Circles / {{ $circles->count() }} circles
    @endsection
    @if(auth()->user()->role == 'admin')
        <a href="{{ route('circles.create') }}">Add Circle</a>
    @endif
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif
    @if ($circles->isEmpty())
        <p>No circles found.</p>
    @else
    <table border="1">
        <tr>
            <th>Name</th>
            @if(auth()->user()->role == 'admin')
                <th>Teacher</th>

                <th>Actions</th>
            @endif
            <th>View</th>
        </tr>

        @foreach($circles as $circle)
            <tr>
                <td>{{ $circle->name }}</td>

                @if(auth()->user()->role == 'admin')
                    <td>{{ $circle->teacher->name ?? '-' }}</td>

                    <td>

                        <a href="{{ route('circles.edit', $circle->id) }}">Edit</a>

                        <form action="{{ route('circles.destroy', $circle->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>

                    </td>
                @endif
                <td><a href="{{ route('circles.show', $circle->id) }}">
                        View
                    </a></td>
            </tr>
        @endforeach
    </table>
    @endif
</x-app-layout>
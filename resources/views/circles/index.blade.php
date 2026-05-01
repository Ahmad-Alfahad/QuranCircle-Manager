<x-app-layout>
    @section('title', 'Circles')
    @section('breadcrumbs')
    Dashboard / Circles / {{ $circles->count() }} circles
    @endsection
    <h2>Circles</h2>
    @if(auth()->user()->role == 'admin')
        <a href="{{ route('circles.create') }}">Add Circle</a>
    @endif
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

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
</x-app-layout>
<x-app-layout>
    <h2>Circles</h2>

    <a href="{{ route('circles.create') }}">Add Circle</a>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1">
        <tr>
            <th>Name</th>
            <th>Teacher</th>
            <th>Actions</th>
        </tr>

        @foreach($circles as $circle)
            <tr>
                <td>{{ $circle->name }}</td>
                <td>{{ $circle->teacher->name ?? '-' }}</td>
                <td><a href="{{ route('circles.show', $circle->id) }}">
                        View
                    </a></td>
                <td>
                    <a href="{{ route('circles.edit', $circle->id) }}">Edit</a>

                    <form action="{{ route('circles.destroy', $circle->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</x-app-layout>
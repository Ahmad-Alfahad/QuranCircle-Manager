<x-app-layout>
    <h2>Attendance for {{ $user->name }}</h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Status</th>
                <th>Notes</th>
                @if (in_array(auth()->user()->role, ['admin', 'teacher']))
                    <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($attendance as $att)
                <tr>
                    <td>{{ $att->date }}</td>
                    <td>{{ $att->status }}</td>
                    <td>{{ $att->notes }}</td>
                    @if (in_array(auth()->user()->role, ['admin', 'teacher']))
                        <td>
                            <a href="{{ route('attendance.edit', $att->id) }}?redirect_to={{ url()->current() }}">Edit</a>

                            <form method="POST"
                                action="{{ route('attendance.destroy', $att->id) }}">
                                <input type="hidden" name="redirect_to" value="{{ request('redirect_to') }}">

                                @csrf
                                @method('DELETE')
                                <button>Delete</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
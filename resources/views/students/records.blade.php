<x-app-layout>
    <h2>Records for {{ $user->name }}</h2>
    <table>
        <thead>
            <tr>
                <th>Circle</th>
                <th>Surah</th>
                <th>Range</th>
                <th>Type</th>
                <th>Grade</th>
                <th>Date</th>
                @if (in_array(auth()->user()->role , ['admin', 'teacher']))
                    <th>Actions</th>
                
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($records as $record)
                <tr>
                    <td>{{ $record->circleStudent->circle->name }}</td>
                    <td>{{ $record->surah->name }}</td>
                    <td>{{ $record->from }} - {{ $record->to }}</td>
                    <td>{{ $record->type }}</td>
                    <td>{{ $record->grade }}</td>
                    <td>{{ $record->recorded_at }}</td>
                    @if (in_array(auth()->user()->role, ['admin', 'teacher']))
                        <td>
                            <a href="{{ route('records.edit', $record->id) }}?redirect_to={{ url()->current() }}">Edit</a>

                            <form method="POST" action="{{ route('records.destroy', $record->id) }} }}">
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
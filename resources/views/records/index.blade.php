<x-app-layout>
    <h2>Records</h2>

    <a href="{{ route('records.create') }}">Add Record</a>

    @foreach($records as $record)
        <p>
            {{ $record->circleStudent->student->name }}
            - {{ $record->surah->name }}
            - {{ $record->type }}
            - {{ $record->date }}

            <a href="{{ route('records.edit', $record->id) }}">Edit</a>

            <form method="POST" action="{{ route('records.destroy', $record->id) }}">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
        </p>
    @endforeach
</x-app-layout>
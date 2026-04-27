<x-app-layout>
    <h2>Edit record</h2>
    <form method="POST" action="{{ route('records.update', $record) }}">
        @csrf
        @method('PUT')

        <label>Surah</label>
        <select name="surah_id">
            @foreach($surahs as $surah)
                <option value="{{ $surah->id }}" {{ $record->surah_id == $surah->id ? 'selected' : '' }}>
                    {{ $surah->name }}
                </option>
            @endforeach
        </select>

        <label>From</label>
        <input type="number" name="from" value="{{ $record->from }}">

        <label>To</label>
        <input type="number" name="to" value="{{ $record->to }}">

        <label>Type</label>
        <select name="type">
            <option value="memorization" {{ $record->type == 'memorization' ? 'selected' : '' }}>Memorization</option>
            <option value="revision" {{ $record->type == 'revision' ? 'selected' : '' }}>Revision</option>
        </select>
         Grade  
        <input type="number" name="grade" value="{{ $record->grade }}">
        <input type="date" name="recorded_at" value="{{ $record->recorded_at }}">
        <button type="submit">Update</button>
</x-app-layout> 
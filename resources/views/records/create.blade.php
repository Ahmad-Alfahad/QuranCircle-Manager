<x-app-layout>
    <h2>Create Record</h2>

    <form method="POST" action="{{ route('records.store') }}">
        @csrf

        <select name="circle_student_id">
            @foreach($students as $s)
                <option value="{{ $s->id }}">
                    {{ $s->student->name }}
                </option>
            @endforeach
        </select>

        <select name="surah_id">
            @foreach($surahs as $surah)
                <option value="{{ $surah->id }}">
                    {{ $surah->name }}
                </option>
            @endforeach
        </select>

        <select name="type">
            <option value="memorization">Memorization</option>
            <option value="revision">Revision</option>
        </select>

        <select name="method" id="method">
            <option value="ayah">Ayah</option>
            <option value="page">Page</option>
        </select>

       
        <div id="ayah-fields">
            <input type="number" name="from" placeholder="From ">
            <input type="number" name="to" placeholder="To ">
        </div>

      
        <input type="date" name="recorded_at">
        <input type="number" name="grade" placeholder="Grade">
        <textarea name="notes"></textarea>

        <button type="submit">Save</button>
    </form>

</x-app-layout>
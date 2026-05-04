<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Record') }}
        </h2>
    </x-slot>

    <div class="bg-white p-6 rounded shadow max w-xl">
        <label for="student_id">Student name : {{ $record->circleStudent->student->name ?? '' }}</label>
        <form method="post" action="{{ route('records.update', $record) }}">
            @csrf
            @method('PUT')
            @include('records._form', ['record' => $record, 'students' => $students, 'surahs' => $surahs])
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded m-2">
                Update Record
            </button>
        </form>
    </div>
    <a href="{{ route('records.index') }}" class="text-gray-500 text-sm mb-3 inline-block">
        ← Back
    </a>
</x-app-layout>




<!-- 

    <form method="POST" action="{{ route('records.update', $record) }}">
        <input type="hidden" name="redirect_to" value="{{ request('redirect_to') }}">
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
        <button type="submit">Update</button> -->
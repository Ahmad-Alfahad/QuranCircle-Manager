@php
    $record = $record ?? null;
  @endphp
<div class="bg-white  max-w-xl">
    <!-- surah -->
    <div class="mb-4">
        <label for="surah_id">Surah</label>
        <select name="surah_id" id="surah_id" class="w-full border rounded p-2">
            <option value="">Select Surah</option>
            @foreach($surahs as $surah)
                <option value="{{ $surah->id }}" {{ old('surah_id', $record->surah_id ?? '') == $surah->id ? 'selected' : '' }}>
                    {{ $surah->name }}
                </option>
            @endforeach
        </select>
        @error('surah_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- type -->
    <div class="mb-4">
        <label for="type">Type</label>
        <select name="type" id="type" class="w-full border rounded p-2">
            <option value="">Select Type</option>
            <option value="memorization" {{ old('type', $record->type ?? '') == 'memorization' ? 'selected' : '' }}>
                Memorization</option>
            <option value="revision" {{ old('type', $record->type ?? '') == 'revision' ? 'selected' : '' }}>Revision
            </option>
        </select>
        @error('type')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- method -->
    <div class="mb-4">
        <label for="method">Method</label>
        <select name="method" id="method" class="w-full border rounded p-2">
            <option value="">Select Method</option>
            <option value="ayah" {{ old('method', $record->method ?? '') == 'ayah' ? 'selected' : '' }}>Ayah</option>
            <option value="page" {{ old('method', $record->method ?? '') == 'page' ? 'selected' : '' }}>Page</option>
        </select>
        @error('method')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- range  -->
    <div class="mb-4">
        <label for="range">Range</label>
        <div class="flex space-x-2">
            <input type="number" name="from" id="from" placeholder="from" value="{{ old('from', $record->from ?? '') }}"
                class="w-full border rounded p-2" placeholder="e.g. 1-5 or 1-10">
            <input type="number" name="to" id="to" placeholder="to" value="{{ old('to', $record->to ?? '') }}"
                class="w-full border rounded p-2" placeholder="e.g. 1-5 or 1-10">
        </div>
        @error('from')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        @error('to')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- record date -->
    <div class="mb-4">
        <label for="recorded_at">Recorded At</label>
        <input type="date" name="recorded_at" id="recorded_at" placeholder="record date"
            value="{{ old('recorded_at', $record->recorded_at ?? '') }}" class="w-full border rounded p-2">
        @error('recorded_at')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- grade -->
    <div class="mb-4">
        <label for="grade">Grade</label>
        <input type="number" name="grade" id="grade" placeholder="grade"
            value="{{ old('grade', $record->grade ?? '') }}" class="w-full border rounded p-2" placeholder="Grade">
        @error('grade')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- notes -->
    <div class="mb-4">
        <label for="notes">Notes</label>
        <textarea name="notes" id="notes" placeholder="notes"
            class="w-full border rounded p-2">{{ old('notes', $record->notes ?? '') }}</textarea>
        @error('notes')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

    </div>
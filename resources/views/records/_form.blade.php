@php
    $record = $record ?? null;
@endphp

<div class="bg-white shadow rounded-lg p-6 space-y-6">

    <!-- Surah -->
    <div>
        <label for="surah_id"
            class="block text-sm font-medium text-gray-700 mb-1">
            Surah
        </label>

        <select
            name="surah_id"
            id="surah_id"
            class="w-full border rounded-lg p-2"
        >
            <option value="">Select Surah</option>

            @foreach($surahs as $surah)
                <option
                    value="{{ $surah->id }}"
                    {{ old('surah_id', $record->surah_id ?? '') == $surah->id ? 'selected' : '' }}
                >
                    {{ $surah->name }}
                </option>
            @endforeach

        </select>

        @error('surah_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Type & Method -->
    <div class="grid md:grid-cols-2 gap-4">

        <div>
            <label for="type"
                class="block text-sm font-medium text-gray-700 mb-1">
                Type
            </label>

            <select
                name="type"
                id="type"
                class="w-full border rounded-lg p-2"
            >
                <option value="">Select Type</option>

                <option
                    value="memorization"
                    {{ old('type', $record->type ?? '') == 'memorization' ? 'selected' : '' }}
                >
                    Memorization
                </option>

                <option
                    value="revision"
                    {{ old('type', $record->type ?? '') == 'revision' ? 'selected' : '' }}
                >
                    Revision
                </option>

            </select>

            @error('type')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="method"
                class="block text-sm font-medium text-gray-700 mb-1">
                Method
            </label>

            <select
                name="method"
                id="method"
                class="w-full border rounded-lg p-2"
            >
                <option value="">Select Method</option>

                <option
                    value="ayah"
                    {{ old('method', $record->method ?? '') == 'ayah' ? 'selected' : '' }}
                >
                    Ayah
                </option>

                <option
                    value="page"
                    {{ old('method', $record->method ?? '') == 'page' ? 'selected' : '' }}
                >
                    Page
                </option>

            </select>

            @error('method')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

    </div>

    <!-- Range -->
    <div>
        <label
            class="block text-sm font-medium text-gray-700 mb-1">
            Range
        </label>

        <div class="grid grid-cols-2 gap-4">

            <input
                type="number"
                name="from"
                value="{{ old('from', $record->from ?? '') }}"
                placeholder="From"
                class="w-full border rounded-lg p-2"
            >

            <input
                type="number"
                name="to"
                value="{{ old('to', $record->to ?? '') }}"
                placeholder="To"
                class="w-full border rounded-lg p-2"
            >

        </div>

        @error('from')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        @error('to')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Date & Grade -->
    <div class="grid md:grid-cols-2 gap-4">

        <div>
            <label for="recorded_at"
                class="block text-sm font-medium text-gray-700 mb-1">
                Recorded Date
            </label>

            <input
                type="date"
                name="recorded_at"
                id="recorded_at"
                value="{{ old('recorded_at', isset($record) && $record->recorded_at ? \Carbon\Carbon::parse($record->recorded_at)->format('Y-m-d') : now()->format('Y-m-d')) }}"
                class="w-full border rounded-lg p-2"
            >

            @error('recorded_at')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="grade"
                class="block text-sm font-medium text-gray-700 mb-1">
                Grade
            </label>

            <input
                type="number"
                min="0"
                max="100"
                name="grade"
                id="grade"
                value="{{ old('grade', $record->grade ?? '') }}"
                class="w-full border rounded-lg p-2"
                placeholder="0 - 100"
            >

            @error('grade')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

    </div>

    <!-- Notes -->
    <div>
        <label for="notes"
            class="block text-sm font-medium text-gray-700 mb-1">
            Notes
        </label>

        <textarea
            name="notes"
            id="notes"
            rows="4"
            class="w-full border rounded-lg p-2"
            placeholder="Additional notes..."
        >{{ old('notes', $record->notes ?? '') }}</textarea>

        @error('notes')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

</div>
@php
    $circle = $circle ?? null;
@endphp

<div class="bg-white shadow rounded-lg p-6 space-y-6">

    <!-- Circle Name -->
    <div>
        <label for="name"
            class="block text-sm font-medium text-gray-700 mb-1">
            Circle Name
        </label>

        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $circle->name ?? '') }}"
            class="w-full border rounded-lg p-2"
            placeholder="Enter circle name"
        >

        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Teacher -->
    <div>
        <label for="teacher_id"
            class="block text-sm font-medium text-gray-700 mb-1">
            Teacher
        </label>

        <select
            name="teacher_id"
            id="teacher_id"
            class="w-full border rounded-lg p-2"
        >
            <option value="">Select Teacher</option>

            @foreach($teachers as $teacher)

                <option
                    value="{{ $teacher->id }}"
                    {{ old('teacher_id', $circle->teacher_id ?? '') == $teacher->id ? 'selected' : '' }}
                >
                    {{ $teacher->name }}
                </option>

            @endforeach

        </select>

        @error('teacher_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Description -->
    <div>
        <label for="description"
            class="block text-sm font-medium text-gray-700 mb-1">
            Description
        </label>

        <textarea
            id="description"
            name="description"
            rows="4"
            class="w-full border rounded-lg p-2"
            placeholder="Write a description for this circle..."
        >{{ old('description', $circle->description ?? '') }}</textarea>

        @error('description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Times -->
    <div class="grid md:grid-cols-2 gap-4">

        <div>
            <label for="start_time"
                class="block text-sm font-medium text-gray-700 mb-1">
                Start Time
            </label>

            <input
                type="time"
                id="start_time"
                name="start_time"
                value="{{ old('start_time', isset($circle) && $circle->start_time ? substr($circle->start_time, 0, 5) : '') }}"
                class="w-full border rounded-lg p-2"
            >

            @error('start_time')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="end_time"
                class="block text-sm font-medium text-gray-700 mb-1">
                End Time
            </label>

            <input
                type="time"
                id="end_time"
                name="end_time"
                value="{{ old('end_time', isset($circle) && $circle->end_time ? substr($circle->end_time, 0, 5) : '') }}"
                class="w-full border rounded-lg p-2"
            >

            @error('end_time')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

    </div>

</div>
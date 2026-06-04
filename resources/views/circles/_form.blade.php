@php
    $circle = $circle ?? null;
@endphp

<div class="max-w-md bg-white p-6 rounded ">
    <!-- Name -->
    <div class="mb-4 mt-4">
        <label for="name" class="block mb-1">Circle Name</label>

        <input type="text" id="name" name="name" value="{{ old('name', $circle->name ?? '') }}"
            class="w-full border rounded p-2" placeholder="Enter circle name">

        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Teacher -->
    <div class="mb-4">
        <label for="teacher_id" class="block mb-1">Teacher</label>

        <select name="teacher_id" id="teacher_id" class="w-full border rounded p-2">
            <option value="">Select Teacher</option>

            @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}" {{ old('teacher_id', $circle->teacher_id ?? '') == $teacher->id ? 'selected' : '' }}>
                    {{ $teacher->name }}
                </option>
            @endforeach
        </select>

        @error('teacher_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Description -->
    <div class="mb-4">
        <label for="description" class="block mb-1">Description</label>

        <textarea id="description" name="description" rows="4" class="w-full border rounded p-2"
            placeholder="Circle description">{{ old('description', $circle->description ?? '') }}</textarea>

        @error('description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Start Time -->
    <div class="mb-4">
        <label for="start_time" class="block mb-1">Start Time</label>

        <input type="time" id="start_time" name="start_time"
            value="{{ old('start_time', isset($circle) ? substr($circle->start_time, 0, 5) : '') }}"
            class="w-full border rounded p-2">

        @error('start_time')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- End Time -->
    <div class="mb-4">
        <label for="end_time" class="block mb-1">End Time</label>

        <input type="time" id="end_time" name="end_time"
            value="{{ old('end_time', isset($circle) ? substr($circle->end_time, 0, 5) : '') }}"
            class="w-full border rounded p-2">

        @error('end_time')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

</div>
<!-- 
public function create()
{
    $teachers = User::where('role', 'teacher')->get();

    $circle = null;

    return view('circles.create', compact(
        'teachers',
        'circle'
    ));
}

public function edit(Circle $circle)
{
    $teachers = User::where('role', 'teacher')->get();

    return view('circles.edit', compact(
        'circle',
        'teachers'
    ));
} -->
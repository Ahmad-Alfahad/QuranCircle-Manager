@php
    $attendance = $attendance ?? null;
@endphp

<div class="bg-white shadow rounded-lg p-6 space-y-6">

    <!-- Student -->
    <div>
        <label for="circle_student_id"
            class="block text-sm font-medium text-gray-700 mb-1">
            Student
        </label>

        <select
            name="circle_student_id"
            id="circle_student_id"
            class="w-full border rounded-lg p-2"
        >
            <option value="">Select Student</option>

            @foreach($circleStudents as $cs)
                <option
                    value="{{ $cs->id }}"
                    {{ old('circle_student_id', $attendance->circle_student_id ?? '') == $cs->id ? 'selected' : '' }}
                >
                    {{ $cs->student->name }}
                    ({{ $cs->circle->name }})
                </option>
            @endforeach

        </select>

        @error('circle_student_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Date & Status -->
    <div class="grid md:grid-cols-2 gap-4">

        <div>
            <label for="date"
                class="block text-sm font-medium text-gray-700 mb-1">
                Attendance Date
            </label>

            <input
                type="date"
                id="date"
                name="date"
                value="{{ old('date', isset($attendance) ? $attendance->date : now()->format('Y-m-d')) }}"
                class="w-full border rounded-lg p-2"
            >

            @error('date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="status"
                class="block text-sm font-medium text-gray-700 mb-1">
                Status
            </label>

            <select
                name="status"
                id="status"
                class="w-full border rounded-lg p-2"
            >
                <option value="">Select Status</option>

                <option
                    value="present"
                    {{ old('status', $attendance->status ?? '') == 'present' ? 'selected' : '' }}
                >
                    Present
                </option>

                <option
                    value="absent"
                    {{ old('status', $attendance->status ?? '') == 'absent' ? 'selected' : '' }}
                >
                    Absent
                </option>

                <option
                    value="late"
                    {{ old('status', $attendance->status ?? '') == 'late' ? 'selected' : '' }}
                >
                    Late
                </option>

                <option
                    value="excused"
                    {{ old('status', $attendance->status ?? '') == 'excused' ? 'selected' : '' }}
                >
                    Excused
                </option>

            </select>

            @error('status')
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
        >{{ old('notes', $attendance->notes ?? '') }}</textarea>

        @error('notes')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

</div>
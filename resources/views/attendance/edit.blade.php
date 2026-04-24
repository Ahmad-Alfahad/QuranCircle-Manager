<x-app-layout>
    <h2>Edit Attendance</h2>

    <form method="POST" action="{{ route('attendance.update', $attendance->id) }}">
        @csrf
        @method('PUT')

        <select name="circle_student_id">
            @foreach($students as $s)
                <option value="{{ $s->id }}"
                    {{ $attendance->circle_student_id == $s->id ? 'selected' : '' }}>
                    {{ $s->student->name }}
                </option>
            @endforeach
        </select>

        <input type="date" name="date" value="{{ $attendance->date }}">

        <select name="status">
            <option value="present" {{ $attendance->status == 'present' ? 'selected' : '' }}>Present</option>
            <option value="absent" {{ $attendance->status == 'absent' ? 'selected' : '' }}>Absent</option>
            <option value="late" {{ $attendance->status == 'late' ? 'selected' : '' }}>Late</option>
        </select>

        <textarea name="notes">{{ $attendance->notes }}</textarea>

        <button type="submit">Update</button>
    </form>
</x-app-layout>
<x-app-layout>
    <h2>Create Attendance</h2>

    <form method="POST" action="{{ route('attendance.store') }}">
        @csrf

        <select name="circle_student_id">
            @foreach($students as $s)
                <option value="{{ $s->id }}">
                    {{ $s->student->name }}
                </option>
            @endforeach
        </select>

        <input type="date" name="date">

        <select name="status">
            <option value="present">Present</option>
            <option value="absent">Absent</option>
            <option value="late">Late</option>
        </select>

        <textarea name="notes" placeholder="Notes"></textarea>

        <button type="submit">Save</button>
    </form>
</x-app-layout>
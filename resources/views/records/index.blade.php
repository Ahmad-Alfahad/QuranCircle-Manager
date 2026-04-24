<x-app-layout>
    <h2>Records</h2>



    <form method="GET" action="{{ route('records.index') }}">

    <select name="circle_id">
        <option value="">All Circles</option>
        @foreach($circles as $circle)
            <option value="{{ $circle->id }}"
                {{ request('circle_id') == $circle->id ? 'selected' : '' }}>
                {{ $circle->name }}
            </option>
        @endforeach
    </select>

    <select name="student_id">
        <option value="">All Students</option>
        @foreach($students as $s)
            <option value="{{ $s->student->id }}"
                {{ request('student_id') == $s->student->id ? 'selected' : '' }}>
                {{ $s->student->name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Filter</button>
</form>
  
@foreach($records as $record)
    <p>
        {{ $record->circleStudent->student->name }}
        - {{ $record->circleStudent->circle->name }}
        - {{ $record->surah->name }}

        - 
            {{ $record->from}} → {{ $record->to }}
      

        - {{ $record->type }}
        - {{ $record->recorded_at ?? $record->date }}
        
    </p>
@endforeach
  <a href="{{ route('records.create') }}">Add Record</a>

</x-app-layout>
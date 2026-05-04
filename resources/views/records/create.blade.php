<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Record') }}
        </h2>
    </x-slot>

    <div class="bg-white p-6 rounded shadow max-w-xl">

        <form method="POST" action="{{ route('records.store') }}">
            @csrf
            <div class="mb-4">
               <label for="student_id">Student</label>
                <select name="circle_student_id" id="student_id" class="w-full border rounded p-2">
                    <option value="">Select Student</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" {{ old('circle_student_id', $record->circle_student_id ?? '') == $student->id ? 'selected' : '' }}>
                            {{ $student->circle->name }} - {{ $student->student->name }}
                        </option>
                    @endforeach
                </select>
                @error('circle_student_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            @include('records._form')

            <button class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded m-2">
                Create
            </button>
        </form>

    </div>
    <a href="{{ route('records.index') }}" class="text-gray-500 text-sm mb-3 inline-block">
        ← Back
    </a>
</x-app-layout>
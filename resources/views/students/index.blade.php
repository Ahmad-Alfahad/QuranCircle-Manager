<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Students
        </h2>
            @if(auth()->user()->role == 'admin')
      
        <button><a href="{{ route('students.create') }}" class="bg-green-500 text-white p-2 rounded hover:bg-green-600">
            Create Student
        </a></button>
      </div>
    @endif
    </x-slot>

    @section('title', 'Students')
    @section('breadcrumbs')
        Dashboard / Students / {{ $students->count() }} students
    @endsection

<div class="m-6">
    @if ($students->isEmpty())
        <p>No students found.</p>
    @else
        <div  class="bg-white shadow rounded">
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 text-left">Name</th>
                        <th class="p-2 text-left">Email</th>
                        <th class="p-2 text-left">Circle</th>
                        @if (in_array(auth()->user()->role , ['admin' , 'teacher']))
                            <th class="p-2 text-left">Actions</th>

                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr class="border-t hover:bg-gray-100">
                            <td class="p-1">{{ $student->name }}</td>
                            <td class="p-1">{{ $student->email }}</td>
                            <td class="p-1">{{$student->circleStudents->first()?->circle->name ?? 'N/A' }}</td>
                            @if (in_array(auth()->user()->role , ['admin' , 'teacher']))
                                <td class="p-1">
                                   <div class="flex space-x-2">
                                    <a href="{{ route('students.show', $student->id) }}"
                                        class="text-gray-500 text-sm mb-3 inline-block ml-2">
                                        View
                                    </a>

                                    @if(auth()->user()->role == 'admin')
                                        <a href="{{ route('students.edit', $student->id) }}"
                                            class="text-gray-500 text-sm mb-3 inline-block ml-2">
                                            | Edit
                                        </a>

                                        <form method="POST" action="{{ route('students.destroy', $student->id) }}" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-gray-500 text-sm mb-3 inline-block ml-2">
                                                | Delete
                                            </button>
                                        </form>
                                    @endif
                                    </div>
                                </td>
                            @endif

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    </div>
</x-app-layout>
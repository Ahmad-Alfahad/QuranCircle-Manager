<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Page
        </h2>
    </x-slot>
    <div class="bg-white p-6 rounded shadow max w-xl">
        <form method="POST" action="{{ route('students.update', $user->id) }}">
            @csrf
            @method('PUT')

            @include('students._form', ['user' => $user] )
             <button
                class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded m-2">
                Update
            </button>
        </form>
        <a href="{{ route('students.index') }}" class="text-gray-500 text-sm mb-3 inline-block">
            ← Back
        </a>
    </div>
</x-app-layout>
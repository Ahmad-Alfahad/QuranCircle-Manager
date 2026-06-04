<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Circle') }}
            </h2>
    </x-slot>
    <form method="POST" action="{{ route('circles.store') }}">
        @csrf

        @include('circles._form')

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
            Create Circle
        </button>
    </form>
    <a href="{{ route('circles.index') }}" class="text-gray-500 text-sm mb-3 inline-block">
        ← Back
    </a>
</x-app-layout>
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Circle
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto">

            <form method="POST" action="{{ route('circles.update', $circle) }}">
                @csrf
                @method('PUT')

                @include('circles._form')

                <div class="flex justify-end gap-3 mt-6">

                    <a href="{{ route('circles.index') }}"
                       class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Update Circle
                    </button>

                </div>

            </form>

        </div>
    </div>

</x-app-layout>
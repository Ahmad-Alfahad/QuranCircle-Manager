<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


<div class="grid grid-cols-1 md:grid-cols-3 gap-4 m-4 ">

    @foreach($stats as $key => $value)
        <div class="bg-white p-3 rounded shadow">

            <h3 class="text-gray-500 text-sm">
                {{ ucfirst($key) }}
            </h3>

            <p class="text-2xl font-bold">
                {{ $value }}
            </p>

        </div>
    @endforeach

</div>

<div class="rounded shadow p-2">
<h3 class="text-lg font-semibold mb-1">Recent Records</h3>
<table class="min-w-full bg-white">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2 text-left">Student Name</th>
            <th class="p-2 text-left">Surah</th>
            <th class="p-2 text-left">Type</th>
            <th class="p-2 text-left">Grade</th>
        </tr>
    </thead>
    <tbody>
        @foreach($recentRecords as $record)
            <tr class="border-t hover:bg-gray-100">
                <td class="p-1">{{ $record->circleStudent->student->name ?? '' }}</td>
                <td class="p-1">{{ $record->surah->name ?? '' }}</td>
                <td class="p-1">{{ ucfirst($record->type) }}</td>
                <td class="p-1">{{ $record->grade }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>

</x-app-layout>

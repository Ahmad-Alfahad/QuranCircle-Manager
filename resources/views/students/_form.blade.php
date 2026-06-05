@php
    $user = $user ?? null;
@endphp

<div class="bg-white shadow rounded-lg p-6 space-y-6">

    <!-- Name -->
    <div>
        <label
            for="name"
            class="block text-sm font-medium text-gray-700 mb-1">
            Name
        </label>

        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $user->name ?? '') }}"
            class="w-full border rounded-lg p-2"
            placeholder="Enter student name"
        >

        @error('name')
            <p class="text-red-500 text-sm mt-1">
                {{ $message }}
            </p>
        @enderror
    </div>

    <!-- Email -->
    <div>
        <label
            for="email"
            class="block text-sm font-medium text-gray-700 mb-1">
            Email
        </label>

        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email', $user->email ?? '') }}"
            class="w-full border rounded-lg p-2"
            placeholder="Enter email address"
        >

        @error('email')
            <p class="text-red-500 text-sm mt-1">
                {{ $message }}
            </p>
        @enderror
    </div>

    <!-- Password -->
    <div>
        <label
            for="password"
            class="block text-sm font-medium text-gray-700 mb-1">
            Password
        </label>

        <input
            type="password"
            id="password"
            name="password"
            class="w-full border rounded-lg p-2"
            placeholder="{{ $user ? 'Leave empty to keep current password' : 'Enter password' }}"
        >

        @error('password')
            <p class="text-red-500 text-sm mt-1">
                {{ $message }}
            </p>
        @enderror
    </div>

    <!-- Circle -->
    <div>
        <label
            for="circle_id"
            class="block text-sm font-medium text-gray-700 mb-1">
            Circle
        </label>

        <select
            name="circle_id"
            id="circle_id"
            class="w-full border rounded-lg p-2"
        >
            <option value="">
                Select Circle
            </option>

            @foreach($circles as $circle)
                <option
                    value="{{ $circle->id }}"
                    {{ old('circle_id', $user?->circleStudents->first()?->circle_id) == $circle->id ? 'selected' : '' }}
                >
                    {{ $circle->name }}
                </option>
            @endforeach

        </select>

        @error('circle_id')
            <p class="text-red-500 text-sm mt-1">
                {{ $message }}
            </p>
        @enderror
    </div>

</div>
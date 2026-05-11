@php
    $user = $user ?? null;
  @endphp
<div class="bg-white  max-w-xl">
    <!-- name -->
    <div class="mb-4">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Name" value="{{ old('name', $user->name ?? '') }}"
            class="w-full border rounded p-2">
        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <!-- email -->
    <div class="mb-4">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Email" value="{{  old('email', $user->email ?? '')}}"
            class="w-full border rounded p-2">
        @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <!-- password -->
    <div class="mb-4">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password" class="w-full border rounded p-2">
        @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <!-- circle -->
    <div class="mb-4">
        <label for="circle">Circle Name</label>
        <select name="circle_id" id="circle" class="w-full border rounded p-2">
            @foreach($circles as $circle)
                <option value="{{ $circle->id }}" {{ old('circle_id', $user?->circleStudents->first()?->circle_id) == $circle->id ? 'selected' : '' }}>

                    {{ $circle->name }}
                </option>
            @endforeach
        </select>
        @error('circle_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

</div>
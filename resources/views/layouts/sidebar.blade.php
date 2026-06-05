<!-- 🧭 Sidebar -->
<div class="min-w-full min-h-full shadow-md p-4">

    <h2 class="text-xl bg-green-500 text-white font-bold mb-4 p-2 rounded border-green-500">Quran System</h2>

    <nav class="flex flex-col space-y-2 w-full p-2 rounded ">

        <a href="{{ route('dashboard') }}"
            class="px-3 py-2 bg-green-500 text-white rounded hover:bg-green-600 {{ request()->routeIs('dashboard') ? 'bg-gray-300 font-semibold' : '' }}">
            Dashboard
        </a>

        @if(in_array(auth()->user()->role, ['admin', 'teacher']))
            <a href="{{ route('students.index') }}"
                class="px-3 py-2 bg-green-500 text-white rounded hover:bg-green-600 {{ request()->routeIs('students.*') ? 'bg-gray-300 font-semibold' : '' }}">
                Students
            </a>
        @endif

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('circles.index') }}"
                class="px-3 py-2 bg-green-500 text-white rounded hover:bg-green-600 {{ request()->routeIs('circles.*') ? 'bg-gray-300 font-semibold' : '' }}">
                Circles
            </a>

            <a href="{{ route('users.index') }}"
                class="px-3 py-2 bg-green-500 text-white rounded hover:bg-green-600 {{ request()->routeIs('users.*') ? 'bg-gray-300 font-semibold' : '' }}">
                Users
            </a>
        @endif

        @if (auth()->user()->role !== 'user')
            <a href="{{ route('records.index') }}"
                class="px-3 py-2 bg-green-500 text-white rounded hover:bg-green-600 {{ request()->routeIs('records.*') ? 'bg-gray-300 font-semibold' : '' }}">
                Records
            </a>


            <a href="{{ route('attendance.index') }}"
                class="px-3 py-2 bg-green-500 text-white rounded hover:bg-green-600 {{ request()->routeIs('attendance.*') ? 'bg-gray-300 font-semibold' : '' }}">
                Attendance
            </a>
        @endif
        <a href="{{ route('profile.edit') }}"
            class="px-3 py-2 bg-green-500 text-white rounded hover:bg-green-600 {{ request()->routeIs('profile.*') ? 'bg-gray-300 font-semibold' : '' }}">
            Profile
        </a>

    </nav>

    <div class="mt-10 border-t pt-4 text-center">
        <p class="text-sm text-gray-600">{{ auth()->user()->name }}</p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-red-500 text-sm mt-2">Logout</button>
        </form>
    </div>

</div>
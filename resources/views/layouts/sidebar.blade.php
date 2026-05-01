<div class="p-4 bg-gray-800 text-white min-h-screen ">
    <div class="p-4 text-lg font-bold">
        Dashboard
    </div>

    <ul class="mt-4">
        <li class="p-3 hover:bg-gray-700 {{ request()->routeIs('dashboard') ? 'bg-gray-700' : '' }}">
            <a href="/dashboard">Dashboard</a>
        </li>
        
        @if(in_array(auth()->user()->role, ['admin', 'teacher']))
        <li class="p-3 hover:bg-gray-700 {{ request()->routeIs('students.index') ? 'bg-gray-700' : '' }}">
            <a href="/students">Students</a>
        </li>
        <li class="p-3 hover:bg-gray-700 {{ request()->routeIs('users.index') ? 'bg-gray-700' : '' }}">
            <a href="/users">Users</a>
        </li>
        @endif

         <li class="p-3 hover:bg-gray-700 {{ request()->routeIs('profile.edit') ? 'bg-gray-700' : '' }}">
            <a href="/profile/edit">Profile</a>

        <li class="p-3 hover:bg-gray-700 {{ request()->routeIs('attendance.index') ? 'bg-gray-700' : '' }}">
            <a href="/attendance">Attendance</a>
        </li>

        <li class="p-3 hover:bg-gray-700 {{ request()->routeIs('circles.index') ? 'bg-gray-700' : '' }}">
            <a href="/circles">Circles</a>
        </li>
        <li class="p-3 hover:bg-gray-700 {{ request()->routeIs('records.index') ? 'bg-gray-700' : '' }}">
            <a href="/records">Records</a>
        </li>
        

        
    </ul>
</div>
<x-app-layout>
    <h2>Create Student</h2>

    <form method="POST" action="{{ route('students.store') }}">
        @csrf

        <input type="text" name="name" placeholder="Name">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">

        <select name="circle_id">
            @foreach($circles as $circle)
                <option value="{{ $circle->id }}">{{ $circle->name }}</option>
            @endforeach
        </select>
        
        <button type="submit">Save</button>
    </form>
</x-app-layout>
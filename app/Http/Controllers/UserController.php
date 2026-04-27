<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\CircleStudent;
use App\Models\Circle;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->role;

        $users = User::when($role, function ($query) use ($role) {
            $query->where('role', $role);
        })->get();
        $circles = Circle::all();

        

        return view('users.index', compact('users', 'role' , 'circles'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,teacher,student,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User created');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required|in:admin,teacher,student,user',
        ]);

        $data = $request->only(['name', 'email', 'role']);

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Updated');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Deleted');
    }
   public function makeStudent(Request $request, User $user)
{
    $request->validate([
        'circle_id' => 'required|exists:circles,id'
    ]);

    // تحويل إلى طالب
    $user->update([
        'role' => 'student'
    ]);

    // ربط بالحلقة
    CircleStudent::create([
        'circle_id' => $request->circle_id,
        'student_id' => $user->id,
        'joined_at' => now()
    ]);

    return back()->with('success', 'User converted and assigned');
}


}
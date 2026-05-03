<?php
namespace App\Policies\Traits;
trait HandlesRoles
{
    public function isAdmin($user)
    {
        return $user->role === 'admin';
    }

    public function isTeacher($user)
    {
        return $user->role === 'teacher';
    }

    public function isStudent($user)
    {
        return $user->role === 'student';
    }
}
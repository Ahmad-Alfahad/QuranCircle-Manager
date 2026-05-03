<?php

namespace App\Policies;

use App\Models\Record;
use App\Models\User;
use HandlesRoles;
use Illuminate\Auth\Access\Response;

class RecordPolicy
{
    use HandlesRoles;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role ,
         ['admin',
          'teacher' , 
          'student'
          ]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Record $record): bool
    {    if($this->isAdmin($user)) {
        return true ;
         }  elseif($this->isTeacher($user)) { 

            return $record->circleStudent->circle->teacher_id === $user->id ;

         } elseif($this->isStudent($user)) {

            return $record->circleStudent->student_id === $user->id ;

         }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {   
        return in_array($user->role , ['admin' , 'teacher']) ;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Record $record): bool
    {
        return $this->view($user , $record) ;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Record $record): bool
    {
         return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Record $record): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Record $record): bool
    {
        return false;
    }
}

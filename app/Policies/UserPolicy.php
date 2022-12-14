<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->authorization->role_code, [Role::root()->role_code, Role::admin()->role_code]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return in_array($user->authorization->role_code, [Role::root()->role_code, Role::admin()->role_code]);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->authorization->role_code, [Role::root()->role_code, Role::admin()->role_code]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return in_array($user->authorization->role_code, [Role::root()->role_code, Role::admin()->role_code]);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return in_array($user->authorization->role_code, [Role::root()->role_code, Role::admin()->role_code]);
    }

    /**
     * Determine whether the user can view any models but trashed records.
     */
    public function trash(User $user): bool
    {
        return $user->authorization->role_code === Role::root()->role_code;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user): bool
    {
        return $user->authorization->role_code === Role::root()->role_code;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user): bool
    {
        return false;
    }
}

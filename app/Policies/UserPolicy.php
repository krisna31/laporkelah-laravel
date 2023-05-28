<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role_id, [Role::$IS_SUPERADMIN, Role::$IS_ADMIN]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return ($user->role_id === Role::$IS_SUPERADMIN)
            ||
            ($user->role_id === Role::$IS_ADMIN && $user->company_id === $model->company_id) ||
            ($user->role_id === Role::$IS_USER && $user->id === $model->id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role_id, [Role::$IS_SUPERADMIN, Role::$IS_ADMIN]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return ($user->role_id === Role::$IS_SUPERADMIN)
            ||
            ($user->role_id === Role::$IS_ADMIN && $user->company_id === $model->company_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return ($user->role_id === Role::$IS_SUPERADMIN)
            ||
            ($user->role_id === Role::$IS_ADMIN && $user->company_id === $model->company_id);
    }
    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, User $model): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, User $model): bool
    // {
    //     //
    // }
}

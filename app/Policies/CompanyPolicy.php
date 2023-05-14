<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CompanyPolicy
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
    public function view(User $user, Company $company): bool
    {
        return ($user->role_id === Role::$IS_SUPERADMIN)
            ||
            ($user->role_id === Role::$IS_ADMIN && $user->company_id === $company->id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role_id === Role::$IS_SUPERADMIN;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Company $company): bool
    {
        return ($user->role_id === Role::$IS_SUPERADMIN)
            ||
            ($user->role_id === Role::$IS_ADMIN && $user->company_id === $company->id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Company $company): bool
    {
        return $user->role_id === Role::$IS_SUPERADMIN;
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, Company $company): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, Company $company): bool
    // {
    //     //
    // }
}

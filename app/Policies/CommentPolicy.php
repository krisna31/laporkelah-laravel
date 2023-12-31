<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role_id, [Role::$IS_SUPERADMIN, Role::$IS_ADMIN, Role::$IS_USER]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Comment $comment): bool
    {
        return $user->id == Role::$IS_SUPERADMIN ||
            ($user->role_id == Role::$IS_ADMIN && (($user->company_id ?? true) == $comment->report->company_id || $comment->report->company->is_public)) ||
            ($user->role_id == Role::$IS_USER && (($user->company_id ?? true) == $comment->report->company_id || $comment->report->company->is_public));
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role_id, [Role::$IS_SUPERADMIN, Role::$IS_ADMIN, Role::$IS_USER]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Comment $comment): bool
    {
        return $user->id == Role::$IS_SUPERADMIN ||
            (($user->role_id == Role::$IS_ADMIN && $user->id == $comment->user_id) || $comment->report->company->is_public) ||
            (($user->role_id == Role::$IS_ADMIN && $user->id == $comment->user_id));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Comment $comment): bool
    {
        return $user->id == Role::$IS_SUPERADMIN ||
            (($user->role_id == Role::$IS_ADMIN && $user->id == $comment->user_id) || $comment->report->company->is_public) ||
            (($user->role_id == Role::$IS_ADMIN && $user->id == $comment->user_id));
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, Comment $comment): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, Comment $comment): bool
    // {
    //     //
    // }
}

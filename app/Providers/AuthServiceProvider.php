<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('isSuperAdmin', fn($user) => $user->role_id === Role::$IS_SUPERADMIN);
        Gate::define('isAdmin', fn($user) => $user->role_id === Role::$IS_ADMIN);
        Gate::define('isUser', fn($user) => $user->role_id === Role::$IS_USER);
    }
}

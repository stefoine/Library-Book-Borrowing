<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Requirement 2: Only admin users can manage Users
        Gate::define('admin-only', function (User $user) {
            return $user->is_admin === 1;
        });

        // Requirement 2: Users can only view their own account 
        // (Used in Controllers or Blade)
        Gate::define('view-profile', function (User $user, User $profileUser) {
            return $user->id === $profileUser->id || $user->is_admin;
        });
    }
}
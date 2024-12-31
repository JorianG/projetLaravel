<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{


    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('access-module-management', function (User $user) {
            return $user->role === 'teacher'; 
        });

        Gate::define('access-evaluation-management', function (User $user) {
            return $user->role === 'teacher'; 
        });
    }
}

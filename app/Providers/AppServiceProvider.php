<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        # Authorization Role
        Gate::define('root', fn (User $user) => $user->authorization?->role_code === Role::root()->role_code);
        Gate::define('visitor', fn (User $user) => $user->authorization?->role_code === Role::visitor()->role_code);

        # Authorization Status
        Gate::define('status', fn (User $user) => $user->authorization?->status === 'active');
    }
}

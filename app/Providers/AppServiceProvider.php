<?php

namespace App\Providers;

use App\Enums\Authorizations\Statuses;
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
        Gate::define('root_access', function (User $user) {
            return $user->authorization->role_code === Role::root()->role_code;
        });

        Gate::define('admin_access', function (User $user) {
            return in_array($user->authorization->role_code, [Role::root()->role_code, Role::admin()->role_code]);
        });

        Gate::define('visitor', function (User $user) {
            return $user->authorization->role_code === Role::visitor()->role_code;
        });

        # Authorization Status
        Gate::define('status', function (User $user) {
            return $user->authorization->status === Statuses::ACTIVE->value;
        });
    }
}

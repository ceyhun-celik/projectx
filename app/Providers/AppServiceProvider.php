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
        Gate::define('root', fn (User $user) => $user->authorization?->role_id === Role::root()->id);
        Gate::define('visitor', fn (User $user) => $user->authorization?->role_id === Role::visitor()->id);
    }
}

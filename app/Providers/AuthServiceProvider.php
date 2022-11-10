<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Audit;
use App\Models\Authorization;
use App\Models\Role;
use App\Models\User;
use App\Policies\AuditPolicy;
use App\Policies\AuthorizationPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Role::class => RolePolicy::class,
        User::class => UserPolicy::class,
        Authorization::class => AuthorizationPolicy::class,
        Audit::class => AuditPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}

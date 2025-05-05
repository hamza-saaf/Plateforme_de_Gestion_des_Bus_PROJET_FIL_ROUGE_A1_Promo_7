<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Role;
use App\Policies\RolePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Role::class => RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Define gates for each role
        Gate::define('admin-access', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('traveler-access', function ($user) {
            return $user->hasRole('traveler');
        });

        Gate::define('visitor-access', function ($user) {
            return $user->hasRole('visitor');
        });

        // Define gates for specific permissions
        Gate::define('view-routes', function ($user) {
            return $user->hasPermission('view-routes');
        });

        Gate::define('book-tickets', function ($user) {
            return $user->hasPermission('book-tickets');
        });

        Gate::define('manage-users', function ($user) {
            return $user->hasPermission('manage-users');
        });

        Gate::define('manage-routes', function ($user) {
            return $user->hasPermission('manage-routes');
        });

        Gate::define('manage-system', function ($user) {
            return $user->hasPermission('manage-system');
        });
    }
}

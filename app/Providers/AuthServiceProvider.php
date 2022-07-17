<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        foreach (config('auth.roles') as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        foreach (config('auth.permissions') as $role) {
            Permission::firstOrCreate(['name' => $role]);
        }

        foreach (User::all() as $user) {
            $user->assignRole(Role::findByName(config('auth.default_role')));
        }

        $user = User::first();
        if (!empty($user)) {
            $user->assignRole(Role::findByName(config('auth.super_user_role')));
        }

        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            return $user->hasRole(config('auth.super_user_role')) ? true : null;
        });
    }
}

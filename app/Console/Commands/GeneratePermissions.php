<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GeneratePermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate default permissions';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
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
    }
}

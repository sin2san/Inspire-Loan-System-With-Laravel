<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

        //Permissions
        Permission::create(['name' => 'manage admins']);
        Permission::create(['name' => 'manage customers']);
        Permission::create(['name' => 'manage dashboard']);
        Permission::create(['name' => 'manage loans']);
        Permission::create(['name' => 'manage payments']);
        Permission::create(['name' => 'manage profile']);
        Permission::create(['name' => 'manage option']);

        //Roles
        $role = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'customer']);

        //Role Permissions
        $role->givePermissionTo(Permission::all());
        $role2->givePermissionTo(['manage dashboard', 'manage loans', 'manage payments', 'manage profile']);

        //User
        $user = User::create([
            'name'      => 'Super Admin',
            'email'      => 'admin@inspire.com',
            'password'   => Hash::make('admin'),
            'remember_token' => md5(microtime().Config::get('app.key')),
        ]);

        $user2 = User::create([
            'name'      => 'Customer',
            'email'      => 'customer@inspire.com',
            'password'   => Hash::make('customer'),
            'remember_token' => md5(microtime().Config::get('app.key')),
        ]);

        $user->assignRole('admin');
        $user2->assignRole('customer');

        $user->givePermissionTo(Permission::all());
        $user2->givePermissionTo(['manage dashboard', 'manage loans', 'manage payments', 'manage profile']);
    }
}

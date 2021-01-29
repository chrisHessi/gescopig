<?php

use App\Models\Permission;
use App\Models\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = Permission::create([
            'name' => 'Administer roles and permissions'
        ]);

        $role = Role::create([
            'name' => 'admin'
        ]);

        $role->givePermissionTo($permission);

        $user1 = User::create([
            'name' => 'Admin',
            'email' => 'admin@pigiercam.com',
            'password' => 'PigierAdmin2021',
        ]);

        $user1->assignRole($role);

    }
}

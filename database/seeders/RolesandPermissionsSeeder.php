<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesandPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $customer = Role::create(['name' => 'customer']);

        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'create-game']);
        Permission::create(['name' => 'edit-game']);
        Permission::create(['name' => 'view-game']);
        Permission::create(['name' => 'delete-game']);
        Permission::create(['name' => 'send-email']);

        $admin->givePermissionTo(Permission::all());
        $customer->givePermissionTo('view-game');

        $users = User::all();

        foreach ($users as $user) {
            $user->assignRole('customer');
        }

        $admin1 = User::create([
            'name'      => 'Administrator',
            'email'     => 'admin@email.com',
            'password'  => bcrypt('password123')
        ]);

        $customer1 = User::create([
            'name'      => 'Customer',
            'email'     => 'nathanielbatausafgo@gmail.com',
            'password'  => bcrypt('password')
        ]);

        $admin1->assignRole('admin');
        $customer1->assignRole('customer');
    }
}

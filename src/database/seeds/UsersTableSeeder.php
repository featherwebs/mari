<?php

use Featherwebs\Mari\Models\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $superAdmin     = User::create([
            'name'     => 'Featherwebs',
            'username' => 'featherwebs',
            'email'    => 'super@featherwebs.com',
            'password' => bcrypt('secret')
        ]);
        $superAdminRole = Role::whereName('super-admin')->first();
        $superAdmin->attachRole($superAdminRole);

        $admin     = User::create([
            'name'     => 'Administrator',
            'username' => 'admin',
            'email'    => 'admin@featherwebs.com',
            'password' => bcrypt('secret')
        ]);
        $adminRole = Role::whereName('admin')->first();
        $admin->attachRole($adminRole);
    }
}

<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $admin     = User::create([
            'name'     => 'Featherwebs',
            'username' => 'admin',
            'email'    => 'admin@featherwebs.com',
            'password' => bcrypt('secret')
        ]);
        $adminRole = Role::whereName('admin')->first();
        $admin->attachRole($adminRole);
    }
}

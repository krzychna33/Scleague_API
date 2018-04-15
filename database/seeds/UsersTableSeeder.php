<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', 'Admin')->first();
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('admin');
        $user->save();
        $user->roles()->attach($role);

        $role = Role::where('name', 'User')->first();
        $user = new User();
        $user->name = 'user';
        $user->email = 'user@gmail.com';
        $user->password = bcrypt('user');
        $user->save();
        $user->roles()->attach($role);
    }
}

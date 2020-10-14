<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'admin']);
        Permission::create(['name' => 'customer']);
        Role::create(['name' => 'admin'])
            ->givePermissionTo('admin');
        Role::create(['name' => 'client'])
            ->givePermissionTo('customer');
        User::create(['name' => 'Administrator', 'email' => 'admin@gmail.com', 'password' => bcrypt('password')])
            ->assignRole('admin');
        User::create(['name' => 'client', 'email' => 'client@gmail.com', 'password' => bcrypt('password')])
            ->assignRole('client');
    }
}

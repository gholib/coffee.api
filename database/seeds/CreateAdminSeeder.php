<?php

use Illuminate\Database\Seeder;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Modules\Auth\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@admin.tj',
            'password' => bcrypt('123456$'),
            'status' => 'admin'
        ]);

        \App\Modules\Auth\Models\User::create([
            'name' => 'user',
            'email' => 'user@user.tj',
            'password' => bcrypt('123456'),
            'status' => 'user'
        ]);
    }
}

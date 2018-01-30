<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'password' => bcrypt('1234'),
            'email' => 'admin@test.com',
            'role' => 'admin',
            'remember_token' => str_random(10),
            'active' => true,
            'confirmed' => true,
        ]);
    }
}

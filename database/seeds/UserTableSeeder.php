<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'user',
            'email' => '123456789'.'@gmail.com',
            'password' => Hash::make('admin'),
            'token' => Hash::make(str_random(5)),
        ]);

        DB::table('users')->insert([
            'name' => 'user1',
            'email' => '987654321'.'@gmail.com',
            'password' => Hash::make('admin'),
            'token' => Hash::make(str_random(5)),
        ]);

    }
}

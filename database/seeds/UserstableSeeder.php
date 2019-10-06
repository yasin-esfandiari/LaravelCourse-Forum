<?php

use Illuminate\Database\Seeder;

class UserstableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'admin',
            'password' => bcrypt('qwerty'),
            'email' => 'admin@forum.com',
            'avatar' => asset('avatars/avatar.png'),
            'admin' => 1
        ]);

        App\User::create([
            'name' => 'mmd esi',
            'password' => bcrypt('qwerty'),
            'email' => 'mmd@forum.com',
            'avatar' => asset('avatars/avatar.png')
        ]);
    }
}

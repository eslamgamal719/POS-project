<?php

use App\User;
use Illuminate\Database\Seeder;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::Create([
            'first_name' => 'super',
            'last_name'  => 'admin',
            'email'     => 'eslamgamal719a@gmail.com',
            'password' => bcrypt('12345678'),
        ]);


        $user->attachRole('super_admin');
    }
}

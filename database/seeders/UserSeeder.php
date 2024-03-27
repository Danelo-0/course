<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [

                'name' => 'Матвевв Даниил Романович',
                'email' => 'daniil.matveev.01@live.ru',
                'login' => 'admin',
                'password' => Hash::make('admin'),
                'image' => 'uploads/a2.jpg',
                'status' => 'admin',
            ],

            [
                'name' => 'Савельев Кирилл Андреевич',
                'email' => 'user.users@mail.ru',
                'login' => 'user',
                'password' => Hash::make('user'),
                'image' => 'uploads/a2.jpg',
                'status' => 'user',
            ],

        ]);
    }
}

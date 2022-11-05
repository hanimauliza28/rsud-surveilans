<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
            'username' => 'admin',
            'name'=>'Administator',
            'email'=>'admin@rsudbatang.com',
            'password'=> bcrypt('123456'),
            ],
            [
               'username' => 'igd',
               'name'=>'Admin IGD',
               'email'=>'igd@rsudbatang.com',
               'password'=> bcrypt('123456'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}

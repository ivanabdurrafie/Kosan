<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                 => 1,
                'name'               => 'Administrators',
                'email'              => 'super@admin.com',
                'password'           => bcrypt('oskarpra'),
                'remember_token'     => null,
                'verified'           => 1,
                'verified_at'        => '2020-11-10 04:34:50',
                'verification_token' => '',
                'telephone'          => '',
            ],
        ];

        User::insert($users);
    }
}
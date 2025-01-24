<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => config('users.default_user_name'),
                'email' => config('users.default_user_email'),
                'password' => Hash::make(config('users.default_user_password')),
            ],
            [
                'name' => config('users.default_professor_name'),
                'email' => config('users.default_professor_email'),
                'password' => Hash::make(config('users.default_professor_password')),
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }

}

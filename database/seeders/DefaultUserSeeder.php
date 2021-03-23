<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $email = config('auth.default_user.email');
        $password = config('auth.default_user.password');

        if($email and $password){
            User::factory()->create([
                'email' => $email,
                'password' => Hash::make($password)
            ]);
        }
    }
}

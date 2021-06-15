<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Foreach_;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [[
            "name" => 'Ad Min',
            "email" => 'admin@example.com',
            "email_verified_at" => now(),
            "password" => Hash::make("Passwording"),
        ]];

        foreach($users as $thisUser){
            User::create($thisUser);
        }
    }
}

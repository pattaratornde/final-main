<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
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
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'user_type' => '1',
                'password' => bcrypt('12345678'),
                'google_id' => 'NULL'
            ],
            [
                'name' => 'User',
                'email' => 'user@user.com',
                'user_type' => '0',
                'password' => bcrypt('1234'),
                'google_id' => 'NULL'
            ]
        ];

        foreach($user as $key => $value){
            User::create($value);
        }
    }
}

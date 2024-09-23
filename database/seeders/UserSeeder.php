<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'phone' => '01117507344',
            'job_title' => 'Backend Developer',
            'password' => Hash::make('12345678'), // You can set a default password here
            'remember_token' => Str::random(10),
        ];
        $admin =   User::create($data);
        $admin->addRole('admin');

       
    }
}

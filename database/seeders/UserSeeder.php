<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Ivan',
            'last_name'  => 'Doe',
            'email' => 'ivan@mailinator.com',
            'password' => Hash::make(123456),
            'is_verify' => 1,
            'status' => 1,
        ]);
    }
}

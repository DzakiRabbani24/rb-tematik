<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username' => 'admin.123',
            'password' => Hash::make('admin.123'), // Password dienkripsi dengan bcrypt hash
            'role' => 'admin',
        ]);
    }
}
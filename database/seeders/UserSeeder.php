<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User;
        $user->name = 'Admin User';
        $user->email = 'capripio@gmail.com';
        $user->password = Hash::make('password');
        $user->status = 'active';
        $user->save();
        $user->assignRole('super_admin');
    }
}

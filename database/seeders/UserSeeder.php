<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'is_active' => true,
            'role_id' => 1,
            'name' => 'Super Admin',
            'email' => 'superadmin@mail.com',
            'password' => \Hash::make('admin123'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => 1
        ]);
    }
}

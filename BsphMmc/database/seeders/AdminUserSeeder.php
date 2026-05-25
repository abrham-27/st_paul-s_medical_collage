<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Primary admin (for testing)
        User::updateOrCreate(
            ['email' => 'admin@spmmc.test'],
            [
                'name'     => 'SPHMMC Admin',
                'email'    => 'admin@spmmc.test',
                'password' => Hash::make('password123'),
                'role'     => 'admin',
            ]
        );

        // Production admin
        User::updateOrCreate(
            ['email' => 'admin@sphmmc.edu.et'],
            [
                'name'     => 'SPHMMC Admin',
                'email'    => 'admin@sphmmc.edu.et',
                'password' => Hash::make('Admin@123456'),
                'role'     => 'admin',
            ]
        );

        $this->command->info('✅ Admin users created:');
        $this->command->line('   admin@spmmc.test / password123  (local testing)');
        $this->command->line('   admin@sphmmc.edu.et / Admin@123456  (production)');
        $this->command->warn('⚠  Change production password before deploying!');
    }
}

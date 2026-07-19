<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminEmail = env('ADMIN_EMAIL');
        $adminPassword = env('ADMIN_PASSWORD');

        if (! $adminEmail || ! $adminPassword) {
            throw new RuntimeException(
                'ADMIN_EMAIL and ADMIN_PASSWORD must be configured.'
            );
        }

        User::updateOrCreate(
            [
                'email' => $adminEmail,
            ],
            [
                'name' => 'System Administrator',
                'password' => Hash::make($adminPassword),
                'role' => 'admin',
                'account_status' => 'active',
                'district' => 'Colombo',
                'city' => 'Colombo',
                'contact_number' => null,
                'email_verified_at' => now(),
            ]
        );
    }
}
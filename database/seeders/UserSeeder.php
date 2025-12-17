<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\UserRole; // Use your Enum if you have one
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the Super Admin if they don't exist
        $user = User::firstOrCreate(
            ['email' => 'admin@helvetas-wsmis.com'], // Check this email
            [
                'name' => 'System Administrator',
                'password' => Hash::make('password'), // Initial password
                'role' => 'admin', // Or UserRole::ADMIN
                
                // CRITICAL: Set these to NOW() to bypass your security checks
                'email_verified_at' => now(),
            ]
        );

        // Optional: Output feedback to console
        if ($user->wasRecentlyCreated) {
            $this->command->info("✅ Admin user created: {$user->email}");
            $this->command->info("🔑 Password: password");
        } else {
            $this->command->warn("⚠️ Admin user already exists. No changes made.");
        }
    }
}
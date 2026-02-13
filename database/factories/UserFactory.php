<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;   // ← add this
use App\Models\Role;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create a default role
        $role = Role::firstOrCreate(
            ['name' => 'Admin'],
            [
                'id' => (string) Str::uuid(),
                'description' => 'Default admin role',
                'status' => true,
            ]
        );

        // Create a default user with that role
        User::factory()->create([
            'role_id' => $role->id,
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}

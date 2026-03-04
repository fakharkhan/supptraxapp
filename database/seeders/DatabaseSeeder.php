<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed a basic test user for login.
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        $this->call([
            SalesRepresentativeSeeder::class,
            OrganizationSeeder::class,
            OrganizationUserSeeder::class,
            SubscriptionSeeder::class,
        ]);
    }
}

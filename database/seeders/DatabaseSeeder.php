<?php

namespace Database\Seeders;

use App\Models\Organization;
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
        $this->call([
            SalesRepresentativeSeeder::class,
            OrganizationSeeder::class,
        ]);

        $csa = Organization::where('name', 'CSA')->first();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'organization_id' => $csa?->id,
        ]);

        $this->call([
            OrganizationUserSeeder::class,
            SubscriptionSeeder::class,
            InvoiceSeeder::class,
            StateSeeder::class,
            StatusSeeder::class,
            LocationSeeder::class,
            InsuranceCompanySeeder::class,
            AdjusterSeeder::class,
            BoardSeeder::class,
            ClaimCommentSeeder::class,
            ClaimSeeder::class,
        ]);
    }
}

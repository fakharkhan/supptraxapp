<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records = [
            ['organization_name' => 'Apex Roofing & General Contractors', 'created' => '2025-11-10', 'subscription_start' => '2026-02-24', 'subscription_end' => '2026-03-24', 'subscription_model' => 'Monthly', 'status' => 'Active'],
            ['organization_name' => 'Estimate Mastery', 'created' => '2025-09-18', 'subscription_start' => null, 'subscription_end' => null, 'subscription_model' => null, 'status' => 'Trialing'],
            ['organization_name' => 'CR3 American Exteriors', 'created' => '2026-02-27', 'subscription_start' => null, 'subscription_end' => null, 'subscription_model' => null, 'status' => 'Inactive'],
            ['organization_name' => 'Prevail Claims LLC', 'created' => '2025-02-10', 'subscription_start' => null, 'subscription_end' => null, 'subscription_model' => null, 'status' => 'Canceled'],
            ['organization_name' => 'Division 1 Roofing', 'created' => '2025-01-06', 'subscription_start' => null, 'subscription_end' => null, 'subscription_model' => null, 'status' => 'Unpaid'],
            ['organization_name' => 'Test discount', 'created' => '2025-05-26', 'subscription_start' => null, 'subscription_end' => null, 'subscription_model' => null, 'status' => 'Inactive'],
            ['organization_name' => 'JBL Roofing', 'created' => '2024-11-13', 'subscription_start' => null, 'subscription_end' => null, 'subscription_model' => null, 'status' => 'Unpaid'],
            ['organization_name' => 'Gold Medal Roofing', 'created' => '2025-03-21', 'subscription_start' => null, 'subscription_end' => null, 'subscription_model' => null, 'status' => 'Active'],
            ['organization_name' => 'Natalija/SARAH', 'created' => '2024-11-08', 'subscription_start' => null, 'subscription_end' => null, 'subscription_model' => null, 'status' => 'Active'],
            ['organization_name' => 'Curb Appeal Roofing', 'created' => '2024-12-13', 'subscription_start' => null, 'subscription_end' => null, 'subscription_model' => null, 'status' => null],
            ['organization_name' => 'Demo Organization', 'created' => '2024-10-22', 'subscription_start' => null, 'subscription_end' => null, 'subscription_model' => null, 'status' => null],
            ['organization_name' => 'Bbox', 'created' => '2024-10-18', 'subscription_start' => null, 'subscription_end' => null, 'subscription_model' => null, 'status' => 'Inactive'],
            ['organization_name' => 'CSA', 'created' => '2024-10-17', 'subscription_start' => '2024-10-17', 'subscription_end' => '2025-10-17', 'subscription_model' => 'Yearly', 'status' => 'Active'],
        ];

        foreach ($records as $record) {
            $org = Organization::where('name', $record['organization_name'])->first();
            if (!$org) {
                continue;
            }

            Subscription::updateOrCreate(
                [
                    'organization_id' => $org->id,
                    'created_at_source' => $record['created'],
                ],
                [
                    'subscription_start' => $record['subscription_start'],
                    'subscription_end' => $record['subscription_end'],
                    'subscription_model' => $record['subscription_model'],
                    'status' => $record['status'],
                ],
            );
        }
    }
}

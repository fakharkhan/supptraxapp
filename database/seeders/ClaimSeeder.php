<?php

namespace Database\Seeders;

use App\Models\Adjuster;
use App\Models\Claim;
use App\Models\InsuranceCompany;
use App\Models\Location;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ClaimSeeder extends Seeder
{
    public function run(): void
    {
        $claims = [
            [
                'location' => 'Able Roofing',
                'claimant' => 'LORRAINE STICKEL',
                'claim_date' => '2025-10-03',
                'submission_date' => '2025-10-02',
                'funding_date' => '2026-03-03',
                'status' => 'STRN',
                'insurance' => 'Erie',
                'adjuster_name' => null,
                'claim_handler' => 'Elizabeta Gruevski',
                'client' => 'David Hughes',
            ],
            [
                'location' => 'Able Roofing',
                'claimant' => 'STEPHEN & CHARLENE SHOVER',
                'claim_date' => '2026-01-30',
                'submission_date' => null,
                'funding_date' => '2026-02-09',
                'status' => 'WSC',
                'insurance' => 'State Farm',
                'adjuster_name' => 'Aaron McCloud',
                'claim_handler' => 'N/A',
                'client' => 'Sarah McGarvey',
            ],
            [
                'location' => 'Able Roofing',
                'claimant' => 'KEVIN OWENS',
                'claim_date' => '2026-01-05',
                'submission_date' => null,
                'funding_date' => '2026-02-05',
                'status' => 'ESTI',
                'insurance' => 'Erie',
                'adjuster_name' => 'Chad Barnes',
                'claim_handler' => 'N/A',
                'client' => 'Sarah McGarvey',
            ],
            [
                'location' => 'Able Roofing',
                'claimant' => 'DIANE GALLIERS',
                'claim_date' => '2026-01-05',
                'submission_date' => null,
                'funding_date' => '2026-01-25',
                'status' => 'SS',
                'insurance' => 'Travelers',
                'adjuster_name' => 'Cameron Lane',
                'claim_handler' => 'N/A',
                'client' => 'Sarah McGarvey',
            ],
            [
                'location' => 'Able Roofing',
                'claimant' => 'MARK & ROBIN TODD',
                'claim_date' => '2026-01-05',
                'submission_date' => null,
                'funding_date' => null,
                'status' => 'CBC',
                'insurance' => 'Nationwide',
                'adjuster_name' => 'Rick Pearson',
                'claim_handler' => 'N/A',
                'client' => 'Sarah McGarvey',
            ],
            [
                'location' => 'Mr. Roof',
                'claimant' => 'JOHN PERRY',
                'claim_date' => '2025-08-08',
                'submission_date' => '2025-08-07',
                'funding_date' => '2025-08-14',
                'status' => 'CBC',
                'insurance' => 'USAA',
                'adjuster_name' => 'Tim Cullennen',
                'claim_handler' => null,
                'client' => null,
            ],
            [
                'location' => 'Division 1',
                'claimant' => 'MARY FRENCH',
                'claim_date' => '2025-10-29',
                'submission_date' => '2025-10-28',
                'funding_date' => '2025-10-31',
                'status' => 'SS',
                'insurance' => 'Erie',
                'adjuster_name' => null,
                'claim_handler' => null,
                'client' => null,
            ],
        ];

        foreach ($claims as $data) {
            $location = Location::where('name', $data['location'])->first();
            if (! $location) {
                continue;
            }

            $status = Status::where('abbreviation', $data['status'])->first();
            $insurance = InsuranceCompany::where('name', $data['insurance'])->first();
            $adjuster = $data['adjuster_name']
                ? Adjuster::where('name', $data['adjuster_name'])->first()
                : null;

            Claim::updateOrCreate(
                [
                    'location_id' => $location->id,
                    'claimant' => $data['claimant'],
                ],
                [
                    'location_id' => $location->id,
                    'claimant' => $data['claimant'],
                    'claim_date' => $data['claim_date'] ? Carbon::parse($data['claim_date']) : null,
                    'submission_date' => $data['submission_date'] ? Carbon::parse($data['submission_date']) : null,
                    'funding_date' => $data['funding_date'] ? Carbon::parse($data['funding_date']) : null,
                    'status_id' => $status?->id,
                    'insurance_company_id' => $insurance?->id,
                    'adjuster_id' => $adjuster?->id,
                    'claim_handler' => $data['claim_handler'],
                    'client' => $data['client'],
                    'settlement_amount' => in_array($data['status'] ?? '', ['SS', 'CBC']) ? fake()->randomFloat(2, 1500, 8500) : null,
                ],
            );
        }
    }
}

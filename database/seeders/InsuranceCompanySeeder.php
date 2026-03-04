<?php

namespace Database\Seeders;

use App\Models\InsuranceCompany;
use Illuminate\Database\Seeder;

class InsuranceCompanySeeder extends Seeder
{
    public function run(): void
    {
        $companies = [
            ['name' => 'AAA', 'location' => 'FL', 'phone_number' => '8006725246', 'email' => 'myclaim@csaa.com', 'adjusters_count' => 13],
            ['name' => 'Action claims', 'location' => 'AR', 'phone_number' => '8886911095', 'email' => 'Info@ActionClaimService.com', 'adjusters_count' => 1],
            ['name' => 'Acuity', 'location' => 'WI', 'phone_number' => '8002427666', 'email' => 'claims@acuity.com', 'adjusters_count' => 2],
            ['name' => 'Allstate', 'location' => 'IL', 'phone_number' => '8003478517', 'email' => 'claims@claims.allstate.com', 'adjusters_count' => 165],
            ['name' => 'American Family (AMFAM)', 'location' => 'Wisconsin', 'phone_number' => '8006926326', 'email' => 'claimdocuments@afics.com', 'adjusters_count' => 48],
            ['name' => 'American Modern', 'location' => 'OH', 'phone_number' => '8003752075', 'email' => 'piclaims1@amig.com', 'adjusters_count' => 5],
            ['name' => 'American National', 'location' => 'NY', 'phone_number' => '4097634661', 'email' => 'claimsmail@americannational.com', 'adjusters_count' => 2],
        ];

        foreach ($companies as $company) {
            InsuranceCompany::updateOrCreate(['name' => $company['name']], $company);
        }
    }
}

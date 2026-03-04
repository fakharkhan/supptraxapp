<?php

namespace Database\Seeders;

use App\Models\Adjuster;
use App\Models\InsuranceCompany;
use Illuminate\Database\Seeder;

class AdjusterSeeder extends Seeder
{
    public function run(): void
    {
        $adjusters = [
            ['name' => 'Anita Scroggins', 'company_name' => 'AAA', 'email' => 'Scroggins.Anita@ace.aaa.com', 'phone_number' => '8662222378'],
            ['name' => 'Archaela Jordan', 'company_name' => 'AAA', 'email' => 'Jordan.archaela@ace.aaa.com', 'phone_number' => '8002223612'],
            ['name' => 'Becci Pettitt', 'company_name' => 'AAA', 'email' => 'Rebecca.Pettitt@csaaa.com', 'phone_number' => '9183130538'],
            ['name' => 'Brentson Marcia', 'company_name' => 'AAA', 'email' => 'brentson.marcia@ace.aaa.com', 'phone_number' => '2164637536'],
            ['name' => 'Cody Price', 'company_name' => 'AAA', 'email' => 'price.cody@ace.aaa.com', 'phone_number' => '8009228228'],
            ['name' => 'James Ehko', 'company_name' => 'Allstate', 'email' => 'ehko.james@allstate.com', 'phone_number' => '7248722281'],
            ['name' => 'Kirk Patrick', 'company_name' => 'Allstate', 'email' => 'kirkpatrick.loyd@allstate.com', 'phone_number' => '2147708470'],
        ];

        foreach ($adjusters as $data) {
            $company = InsuranceCompany::where('name', $data['company_name'])->first();
            Adjuster::updateOrCreate(
                ['name' => $data['name'], 'email' => $data['email']],
                [
                    'name' => $data['name'],
                    'company_name' => $data['company_name'],
                    'email' => $data['email'],
                    'phone_number' => $data['phone_number'],
                    'insurance_company_id' => $company?->id,
                ],
            );
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Organization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records = [
            ['organization_name' => 'Apex Roofing & General Contractors', 'invoice_number' => 'ZR310JM3-0005', 'date' => '2026-02-24', 'amount' => 299.00, 'status' => 'Paid'],
            ['organization_name' => 'Apex Roofing & General Contractors', 'invoice_number' => 'ZR310JM3-0004', 'date' => '2026-01-24', 'amount' => 299.00, 'status' => 'Paid'],
            ['organization_name' => 'Division 1 Roofing', 'invoice_number' => '6D410DA8-0002', 'date' => '2026-01-01', 'amount' => 0.00, 'status' => 'Open'],
            ['organization_name' => 'Apex Roofing & General Contractors', 'invoice_number' => 'ZR310JM3-0003', 'date' => '2025-12-24', 'amount' => 299.00, 'status' => 'Paid'],
            ['organization_name' => 'Apex Roofing & General Contractors', 'invoice_number' => 'ZR310JM3-0002', 'date' => '2025-11-24', 'amount' => 299.00, 'status' => 'Paid'],
            ['organization_name' => 'Apex Roofing & General Contractors', 'invoice_number' => 'ZR310JM3-0001', 'date' => '2025-11-10', 'amount' => 0.00, 'status' => 'Paid'],
            ['organization_name' => 'Estimate Mastery', 'invoice_number' => 'TA4SS4BJ-0001', 'date' => '2025-09-18', 'amount' => 0.00, 'status' => 'Paid'],
            ['organization_name' => 'JBL Roofing', 'invoice_number' => '3BDFF9A1-0002', 'date' => '2025-05-13', 'amount' => 0.00, 'status' => 'Open'],
            ['organization_name' => 'Gold Medal Roofing', 'invoice_number' => '212D1020-0002', 'date' => '2025-04-17', 'amount' => 2964.48, 'status' => 'Paid'],
            ['organization_name' => 'Gold Medal Roofing', 'invoice_number' => '212D1020-0001', 'date' => '2025-03-21', 'amount' => 299.00, 'status' => 'Paid'],
            ['organization_name' => 'Prevail Claims LLC', 'invoice_number' => '2D1772F3-0001', 'date' => '2025-02-10', 'amount' => 4999.00, 'status' => 'Paid'],
            ['organization_name' => 'Division 1 Roofing', 'invoice_number' => '6D410DA8-0001', 'date' => '2025-01-08', 'amount' => 0.00, 'status' => 'Paid'],
            ['organization_name' => 'JBL Roofing', 'invoice_number' => '3BDFF9A1-0001', 'date' => '2024-11-14', 'amount' => 0.00, 'status' => 'Paid'],
            ['organization_name' => 'Bbox', 'invoice_number' => '093BE7F8-0001', 'date' => '2024-10-18', 'amount' => 0.00, 'status' => 'Paid'],
        ];

        foreach ($records as $record) {
            $org = Organization::where('name', $record['organization_name'])->first();
            if (!$org) {
                continue;
            }

            Invoice::updateOrCreate(
                [
                    'organization_id' => $org->id,
                    'invoice_number' => $record['invoice_number'],
                ],
                [
                    'date' => $record['date'],
                    'amount' => $record['amount'],
                    'status' => $record['status'],
                ],
            );
        }
    }
}

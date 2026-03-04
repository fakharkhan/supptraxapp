<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\SalesRepresentative;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records = [
            [
                'name' => 'CR3 American Exteriors',
                'sales_person' => 'remko bloemhard',
                'status' => 'Inactive',
                'date_of_registration' => '2026-02-27',
                'organization_address' => '1446 Baltimore St, Ste E',
                'organization_zip' => '17331',
                'organization_state' => 'Pennsylvania',
                'billing_address' => '1446 Baltimore St, Ste E',
                'billing_zip' => '17331',
                'billing_state' => 'Pennsylvania',
                'contact_full_name' => 'Marci Mayfield',
                'contact_phone' => '7177787343',
                'contact_email' => 'mmayfield@cr3america.com',
            ],
            [
                'name' => 'Prevail Claims LLC',
                'sales_person' => 'Becca Switzer',
                'status' => 'Canceled',
                'date_of_registration' => '2025-02-10',
                'organization_address' => '2453 121st circle Ne , Unit i',
                'organization_zip' => '55449',
                'organization_state' => 'Minnesota',
                'billing_address' => '2453 121st circle Ne , Unit i',
                'billing_zip' => '55449',
                'billing_state' => 'Minnesota',
                'contact_full_name' => 'Kirk White',
                'contact_phone' => '7638980787',
                'contact_email' => 'Kirk@prevailclaimsmn.com',
            ],
            [
                'name' => 'Division 1 Roofing',
                'sales_person' => 'remko bloemhard',
                'status' => 'Unpaid',
                'date_of_registration' => '2025-01-06',
                'organization_address' => '400 Metro PI N',
                'organization_zip' => '43017',
                'organization_state' => 'Ohio',
                'billing_address' => '400 Metro PI N',
                'billing_zip' => '43017',
                'billing_state' => 'Ohio',
                'contact_full_name' => 'Logan Galberach',
                'contact_phone' => '6145801937',
                'contact_email' => 'lgalberach@d1roofing.com',
            ],
            [
                'name' => 'Apex Roofing & General Contractors',
                'sales_person' => 'Becca Switzer',
                'status' => 'Active',
                'date_of_registration' => '2025-11-10',
                'organization_address' => '8131 W. Hausman Suite 103',
                'organization_zip' => '78249',
                'organization_state' => 'Texas',
                'billing_address' => '14709 Calamity Way',
                'billing_zip' => '78254',
                'billing_state' => 'Texas',
                'contact_full_name' => 'Carlos Yzaguirre',
                'contact_phone' => '2103644335',
                'contact_email' => 'Carlos@apexroofing.biz',
            ],
            [
                'name' => 'Estimate Mastery',
                'sales_person' => 'remko bloemhard',
                'status' => 'Trialing',
                'date_of_registration' => '2025-09-18',
                'organization_address' => '9970 S 610 E',
                'organization_zip' => '84070',
                'organization_state' => 'Utah',
                'billing_address' => '9970 S 610 E',
                'billing_zip' => '84070',
                'billing_state' => 'Utah',
                'contact_full_name' => 'Alena Wilson',
                'contact_phone' => '5759378350',
                'contact_email' => 'alena@estimatemastery.com',
            ],
            [
                'name' => 'Test discount',
                'sales_person' => 'ProLine 15% Discount',
                'status' => 'Inactive',
                'date_of_registration' => '2025-05-26',
                'organization_address' => 'Skopje',
                'organization_zip' => '11111111',
                'organization_state' => 'Connecticut',
                'billing_address' => 'Skopje',
                'billing_zip' => '11111111',
                'billing_state' => 'Connecticut',
                'contact_full_name' => 'John Doe',
                'contact_phone' => '11111',
                'contact_email' => 'monika+orgadmin@thebrightbox.com',
            ],
            [
                'name' => 'JBL Roofing',
                'sales_person' => 'Remko Demo - 14 day Trial',
                'status' => 'Unpaid',
                'date_of_registration' => '2024-11-13',
                'organization_address' => '7289 State Route 43, Kent',
                'organization_zip' => '44240',
                'organization_state' => 'Ohio',
                'billing_address' => '1031 stone ring ct',
                'billing_zip' => '43240',
                'billing_state' => 'Ohio',
                'contact_full_name' => 'Bill lewis',
                'contact_phone' => '3302218967',
                'contact_email' => 'B.lewis@jblrc.com',
            ],
            [
                'name' => 'Gold Medal Roofing',
                'sales_person' => null,
                'status' => 'Active',
                'date_of_registration' => '2025-03-21',
                'organization_address' => '4471 Dixie Hwy',
                'organization_zip' => '48329',
                'organization_state' => 'Michigan',
                'billing_address' => '389 Roy Hays',
                'billing_zip' => '37664',
                'billing_state' => 'Tennessee',
                'contact_full_name' => 'Kaylie Ledin',
                'contact_phone' => '8654272422',
                'contact_email' => 'kaylie@goldmedalroofing.com',
            ],
            [
                'name' => 'Natalija/SARAH',
                'sales_person' => null,
                'status' => 'Active',
                'date_of_registration' => '2024-11-08',
                'organization_address' => 'Address',
                'organization_zip' => '213123',
                'organization_state' => 'Iowa',
                'billing_address' => 'Address',
                'billing_zip' => '213123',
                'billing_state' => 'Iowa',
                'contact_full_name' => 'Natalija/Sarah',
                'contact_phone' => '111111111',
                'contact_email' => 'natalija+46@thebrightbox.com',
            ],
            [
                'name' => 'Curb Appeal Roofing',
                'sales_person' => null,
                'status' => null,
                'date_of_registration' => '2024-12-13',
                'organization_address' => '9401 Hamilton Rd',
                'organization_zip' => '44060',
                'organization_state' => 'Ohio',
                'billing_address' => '9401 Hamilton Rd',
                'billing_zip' => '44060',
                'billing_state' => 'Ohio',
                'contact_full_name' => 'DJ McConville',
                'contact_phone' => '2164104048',
                'contact_email' => 'Djm@curbappealpainting.com',
            ],
            [
                'name' => 'Demo Organization',
                'sales_person' => null,
                'status' => null,
                'date_of_registration' => '2024-10-22',
                'organization_address' => 'st.Example 123',
                'organization_zip' => '83353',
                'organization_state' => 'Alaska',
                'billing_address' => 'st.Example 123',
                'billing_zip' => '83353',
                'billing_state' => 'Alaska',
                'contact_full_name' => 'Merritt Krajcik',
                'contact_phone' => '7714659262',
                'contact_email' => 'merritt.krajcik@example.net',
            ],
            [
                'name' => 'Bbox',
                'sales_person' => 'Natalija Naumcevska',
                'status' => 'Inactive',
                'date_of_registration' => '2024-10-18',
                'organization_address' => 'Some address',
                'organization_zip' => '1234',
                'organization_state' => 'Ohio',
                'billing_address' => 'Some address',
                'billing_zip' => '1234',
                'billing_state' => 'Ohio',
                'contact_full_name' => 'Panche Gjorgjevski',
                'contact_phone' => '1234567890',
                'contact_email' => 'panetheone@yahoo.com',
            ],
            [
                'name' => 'CSA',
                'sales_person' => null,
                'status' => 'Active',
                'date_of_registration' => '2024-10-17',
                'organization_address' => '1031 Stone Ring Ct',
                'organization_zip' => '43240',
                'organization_state' => 'Ohio',
                'billing_address' => '1031 Stone Ring Ct',
                'billing_zip' => '43240',
                'billing_state' => 'Ohio',
                'contact_full_name' => 'Remko Bloemhard',
                'contact_phone' => '9378691536',
                'contact_email' => 'remkobloemhard@gmail.com',
            ],
        ];

        foreach ($records as $record) {
            $salesPerson = $record['sales_person'] ?? null;
            unset($record['sales_person']);

            $salesRepresentativeId = null;
            if ($salesPerson) {
                $rep = SalesRepresentative::where('name', $salesPerson)->first();
                $salesRepresentativeId = $rep?->id;
            }

            Organization::updateOrCreate(
                ['name' => $record['name']],
                array_merge($record, ['sales_representative_id' => $salesRepresentativeId]),
            );
        }
    }
}

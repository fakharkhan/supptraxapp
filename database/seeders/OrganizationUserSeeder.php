<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\OrganizationUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records = [
            ['organization_name' => 'CR3 American Exteriors', 'user_name' => 'Marci Mayfield', 'user_email' => 'mmayfield@cr3america.com'],
            ['organization_name' => 'Prevail Claims LLC', 'user_name' => 'Kirk White', 'user_email' => 'kirk@prevailclaimsmn.com'],
            ['organization_name' => 'Prevail Claims LLC', 'user_name' => 'Nick Bienias', 'user_email' => 'nick@prevailclaimsmn.com'],
            ['organization_name' => 'Prevail Claims LLC', 'user_name' => 'Tara Quinnell', 'user_email' => 'tara@odysseyext.com'],
            ['organization_name' => 'Division 1 Roofing', 'user_name' => 'Logan Galberach', 'user_email' => 'lgalberach@d1roofing.com'],
            ['organization_name' => 'Division 1 Roofing', 'user_name' => 'Monte Dyke', 'user_email' => 'mdyke@d1roofing.com'],
            ['organization_name' => 'Apex Roofing & General Contractors', 'user_name' => 'Carlos Yzaguirre', 'user_email' => 'carlos@apexroofing.biz'],
            ['organization_name' => 'Apex Roofing & General Contractors', 'user_name' => 'Vannesa Yzaguirre', 'user_email' => 'vannesa@apexroofing.biz'],
            ['organization_name' => 'Apex Roofing & General Contractors', 'user_name' => 'Dan McNiel', 'user_email' => 'dan@apexroofing.biz'],
            ['organization_name' => 'Estimate Mastery', 'user_name' => 'Alena Wilson', 'user_email' => 'alena@estimatemastery.com'],
            ['organization_name' => 'Estimate Mastery', 'user_name' => 'David Jones', 'user_email' => 'david@estimatemastery.com'],
            ['organization_name' => 'Test discount', 'user_name' => 'John Doe', 'user_email' => 'monika+orgadmin@thebrightbox.com'],
            ['organization_name' => 'JBL Roofing', 'user_name' => 'Bill lewis', 'user_email' => 'b.lewis@jblrc.com'],
            ['organization_name' => 'JBL Roofing', 'user_name' => 'Austin Lewis', 'user_email' => 'alewis@jblrc.com'],
            ['organization_name' => 'JBL Roofing', 'user_name' => 'Michelle Hurd', 'user_email' => 'mhurd@jblrc.com'],
            ['organization_name' => 'Gold Medal Roofing', 'user_name' => 'Kaylie Ledin', 'user_email' => 'kaylie@goldmedalroofing.com'],
            ['organization_name' => 'Gold Medal Roofing', 'user_name' => 'Paige Ledin', 'user_email' => 'paige@goldmedalroofing.com'],
            ['organization_name' => 'Natalija/SARAH', 'user_name' => 'Natalija/Sarah', 'user_email' => 'natalija+46@thebrightbox.com'],
            ['organization_name' => 'Natalija/SARAH', 'user_name' => 'Monika Trajkova Atanasova', 'user_email' => 'monika@thebrightbox.com'],
            ['organization_name' => 'Curb Appeal Roofing', 'user_name' => 'DJ McConville', 'user_email' => 'djm@curbappealpainting.com'],
            ['organization_name' => 'Demo Organization', 'user_name' => 'Merritt Krajcik', 'user_email' => 'merritt.krajcik@example.net'],
            ['organization_name' => 'Demo Organization', 'user_name' => 'Doug Bogisich', 'user_email' => 'doug.bogisich@example.net'],
            ['organization_name' => 'Bbox', 'user_name' => 'Panche Gjorgjevski', 'user_email' => 'panetheone@yahoo.com'],
            ['organization_name' => 'CSA', 'user_name' => 'Remko Bloemhard', 'user_email' => 'remkobloemhard@gmail.com'],
            ['organization_name' => 'CSA', 'user_name' => 'Kathryn Virgo', 'user_email' => 'kvirgo@ableroof.com'],
            ['organization_name' => 'CSA', 'user_name' => 'Connor Gorman', 'user_email' => 'cgorman@mrroof.com'],
        ];

        foreach ($records as $record) {
            $org = Organization::where('name', $record['organization_name'])->first();
            if (!$org) {
                continue;
            }

            OrganizationUser::updateOrCreate(
                [
                    'organization_id' => $org->id,
                    'user_email' => $record['user_email'],
                ],
                [
                    'user_name' => $record['user_name'],
                ],
            );
        }
    }
}

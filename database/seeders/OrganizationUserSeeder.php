<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\OrganizationUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationUserSeeder extends Seeder
{
    public function run(): void
    {
        $records = [
            ['organization_name' => 'CR3 American Exteriors', 'user_name' => 'Marci Mayfield', 'user_email' => 'mmayfield@cr3america.com', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'Prevail Claims LLC', 'user_name' => 'Kirk White', 'user_email' => 'kirk@prevailclaimsmn.com', 'type' => 'Org Member', 'is_chaser' => false, 'is_closer' => true, 'claims_count' => 42],
            ['organization_name' => 'Prevail Claims LLC', 'user_name' => 'Nick Bienias', 'user_email' => 'nick@prevailclaimsmn.com', 'type' => 'Org Member', 'is_chaser' => true, 'is_closer' => false, 'claims_count' => 18],
            ['organization_name' => 'Prevail Claims LLC', 'user_name' => 'Tara Quinnell', 'user_email' => 'tara@odysseyext.com', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'Prevail Claims LLC', 'user_name' => 'Cole Quinnell', 'user_email' => 'cole@odysseyext.com', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'Prevail Claims LLC', 'user_name' => 'Lexus Oliver', 'user_email' => 'lexus@tarrytownroofing.com', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'Division 1 Roofing', 'user_name' => 'Logan Galberach', 'user_email' => 'lgalberach@d1roofing.com', 'type' => 'Org Member', 'is_chaser' => true, 'is_closer' => true, 'claims_count' => 35],
            ['organization_name' => 'Division 1 Roofing', 'user_name' => 'Monte Dyke', 'user_email' => 'mdyke@d1roofing.com', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'Apex Roofing & General Contractors', 'user_name' => 'Carlos Yzaguirre', 'user_email' => 'carlos@apexroofing.biz', 'type' => 'Org Member', 'is_chaser' => false, 'is_closer' => true, 'claims_count' => 22],
            ['organization_name' => 'Apex Roofing & General Contractors', 'user_name' => 'Vannesa Yzaguirre', 'user_email' => 'vannesa@apexroofing.biz', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'Apex Roofing & General Contractors', 'user_name' => 'Dan McNiel', 'user_email' => 'dan@apexroofing.biz', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'Estimate Mastery', 'user_name' => 'Alena Wilson', 'user_email' => 'alena@estimatemastery.com', 'type' => 'Org Member', 'is_chaser' => true, 'is_closer' => false, 'claims_count' => 15],
            ['organization_name' => 'Estimate Mastery', 'user_name' => 'David Jones', 'user_email' => 'david@estimatemastery.com', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'JBL Roofing', 'user_name' => 'Bill Lewis', 'user_email' => 'b.lewis@jblrc.com', 'type' => 'Org Member', 'is_chaser' => false, 'is_closer' => true, 'claims_count' => 67],
            ['organization_name' => 'JBL Roofing', 'user_name' => 'Austin Lewis', 'user_email' => 'alewis@jblrc.com', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'JBL Roofing', 'user_name' => 'Michelle Hurd', 'user_email' => 'mhurd@jblrc.com', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'JBL Roofing', 'user_name' => 'Jon Dombrowski', 'user_email' => 'jdombrowski@jblrc.com', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'Gold Medal Roofing', 'user_name' => 'Kaylie Ledin', 'user_email' => 'kaylie@goldmedalroofing.com', 'type' => 'Org Member', 'is_chaser' => true, 'is_closer' => true, 'claims_count' => 51],
            ['organization_name' => 'Gold Medal Roofing', 'user_name' => 'Paige Ledin', 'user_email' => 'paige@goldmedalroofing.com', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'Gold Medal Roofing', 'user_name' => 'Tony Helferich', 'user_email' => 'tony@goldmedalroofing.com', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'Natalija/SARAH', 'user_name' => 'Natalija/Sarah', 'user_email' => 'natalija+46@thebrightbox.com', 'type' => 'Org Member', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'Natalija/SARAH', 'user_name' => 'Monika Trajkova Atanasova', 'user_email' => 'monika@thebrightbox.com', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'Curb Appeal Roofing', 'user_name' => 'DJ McConville', 'user_email' => 'djm@curbappealpainting.com', 'type' => 'Org Member', 'is_chaser' => true, 'is_closer' => false, 'claims_count' => 8],
            ['organization_name' => 'Demo Organization', 'user_name' => 'Merritt Krajcik', 'user_email' => 'merritt.krajcik@example.net', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'Demo Organization', 'user_name' => 'Doug Bogisich', 'user_email' => 'doug.bogisich@example.net', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'Bbox', 'user_name' => 'Panche Gjorgjevski', 'user_email' => 'panetheone@yahoo.com', 'type' => 'Org Member', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            // CSA organization users - from client CSV with full type/chaser/closer/claims data
            ['organization_name' => 'CSA', 'user_name' => 'Kathryn Virgo', 'user_email' => 'kvirgo@ableroof.com', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'CSA', 'user_name' => 'Connor Gorman', 'user_email' => 'cgorman@mrroof.com', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'CSA', 'user_name' => 'David Hughes', 'user_email' => 'dhughes6300@gmail.com', 'type' => 'Org Member', 'is_chaser' => false, 'is_closer' => true, 'claims_count' => 129],
            ['organization_name' => 'CSA', 'user_name' => 'Pat Brady', 'user_email' => 'pb@cranerenovationgroup.com', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'CSA', 'user_name' => 'Zach Comer', 'user_email' => 'zcomer@mrroof.com', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'CSA', 'user_name' => 'David McKinnon', 'user_email' => 'dmckinnon@mrroof.com', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'CSA', 'user_name' => 'Adam Billings', 'user_email' => 'abillings@mrroof.com', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'CSA', 'user_name' => 'Devon Martin', 'user_email' => 'dmartin@mrroof.com', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'CSA', 'user_name' => 'Mackenzie Davenport', 'user_email' => 'mdavenport@mrroof.com', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'CSA', 'user_name' => 'Test - Monika External', 'user_email' => 'monika+external@thebrightbox.com', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'CSA', 'user_name' => 'Remko Bloemhard', 'user_email' => 'remkobloemhard@gmail.com', 'type' => 'Org Member', 'is_chaser' => true, 'is_closer' => false, 'claims_count' => 45],
            // Additional organizations from admin CSV
            ['organization_name' => 'Swift supplementing', 'user_name' => 'Dyhllee Seago', 'user_email' => 'dyhllee@swiftsupplementing.com', 'type' => 'Org Member', 'is_chaser' => false, 'is_closer' => true, 'claims_count' => 12],
            ['organization_name' => 'Swift supplementing', 'user_name' => 'Paola Munoz', 'user_email' => 'saramun1981@gmail.com', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'Pinnacle Estimating', 'user_name' => 'David Clark Dunham', 'user_email' => 'david@pinnacleestimating.com', 'type' => 'Org Member', 'is_chaser' => true, 'is_closer' => true, 'claims_count' => 33],
            ['organization_name' => 'Palapa Ventures LLC', 'user_name' => 'Jesse Oberbeck', 'user_email' => 'joberbeck@gmail.com', 'type' => 'Org Member', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 5],
            ['organization_name' => 'Palapa Ventures LLC', 'user_name' => 'Doug Oberbeck', 'user_email' => 'dcoberbeck@gmail.com', 'type' => 'External User', 'is_chaser' => false, 'is_closer' => false, 'claims_count' => 0],
            ['organization_name' => 'Dream Team Roofing and Construction', 'user_name' => 'Felix DeJesus', 'user_email' => 'felix@dreamteamokla.com', 'type' => 'Org Member', 'is_chaser' => true, 'is_closer' => false, 'claims_count' => 9],
        ];

        foreach ($records as $record) {
            $org = Organization::where('name', $record['organization_name'])->first();
            if (! $org) {
                continue;
            }

            OrganizationUser::updateOrCreate(
                [
                    'organization_id' => $org->id,
                    'user_email' => $record['user_email'],
                ],
                [
                    'user_name' => $record['user_name'],
                    'type' => $record['type'],
                    'is_chaser' => $record['is_chaser'],
                    'is_closer' => $record['is_closer'],
                    'claims_count' => $record['claims_count'],
                ],
            );
        }
    }
}

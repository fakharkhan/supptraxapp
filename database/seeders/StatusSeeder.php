<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['name' => 'Supplement Request', 'abbreviation' => 'SR', 'color' => 'Gray', 'description' => 'A new supplement has been submitted for completion', 'sort_order' => 1],
            ['name' => 'Document Under Review', 'abbreviation' => 'DUR', 'color' => 'Orange', 'description' => 'The supplement has been taken and is being worked on', 'sort_order' => 2],
            ['name' => 'Written Supp. Complete', 'abbreviation' => 'WSC', 'color' => 'Blue', 'description' => 'The supplement is completed and ready for submission to insurance', 'sort_order' => 3],
            ['name' => 'Estimate Sent To Insurance', 'abbreviation' => 'ESTI', 'color' => 'Green', 'description' => 'The supplement has been submitted to insurance and follow-ups must be made', 'sort_order' => 4],
            ['name' => 'Supplement Settled', 'abbreviation' => 'SS', 'color' => 'Purple', 'description' => 'The supplement has been settled and closed', 'sort_order' => 5],
            ['name' => 'None', 'abbreviation' => 'NONE', 'color' => 'Light Green', 'description' => 'The supplement has not clarified the salesperson or insurance status', 'sort_order' => 6],
            ['name' => 'Salesperson Review Required', 'abbreviation' => 'SRR', 'color' => 'Red', 'description' => 'The salesperson needs to look at a particular question or situation', 'sort_order' => 7],
            ['name' => 'Retrieve Final From Insured', 'abbreviation' => 'RFFI', 'color' => 'Pink', 'description' => 'The final estimate can not be retrieved from the insurance company', 'sort_order' => 8],
            ['name' => 'Technical Reply Needed', 'abbreviation' => 'TRN', 'color' => 'Yellow', 'description' => 'The closers team needs to look at a particular question or situation', 'sort_order' => 9],
            ['name' => 'Awaiting Production Photos', 'abbreviation' => 'APP', 'color' => 'Light Blue', 'description' => 'Waiting for photos from the production team - the repair team needs to take photos', 'sort_order' => 11],
            ['name' => 'Sent TRN', 'abbreviation' => 'STRN', 'color' => 'Teal', 'description' => 'Technical response needed has been addressed, and the supplement is being processed', 'sort_order' => 12],
            ['name' => 'Denied', 'abbreviation' => 'DEN', 'color' => 'Orange', 'description' => 'The Denied status indicates that a request or supplement has been denied', 'sort_order' => 13],
            ['name' => 'Cancelled By Contractor', 'abbreviation' => 'CBC', 'color' => 'Red', 'description' => 'The supplement status is yet not defined', 'sort_order' => 14],
        ];

        foreach ($statuses as $status) {
            Status::updateOrCreate(['abbreviation' => $status['abbreviation']], $status);
        }
    }
}

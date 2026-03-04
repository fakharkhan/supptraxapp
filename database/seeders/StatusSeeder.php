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
            ['name' => 'Technical Reply Needed', 'abbreviation' => 'TRN', 'color' => 'Yellow', 'description' => 'The closers team needs to look at a particular question or situation', 'sort_order' => 8],
        ];

        foreach ($statuses as $status) {
            Status::updateOrCreate(['abbreviation' => $status['abbreviation']], $status);
        }
    }
}

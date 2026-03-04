<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            ['name' => 'Able Roofing', 'total_claims' => 129, 'show_board' => true],
            ['name' => 'AM Roofing', 'total_claims' => 29, 'show_board' => true],
            ['name' => 'Division 1', 'total_claims' => 120, 'show_board' => true],
            ['name' => 'Goliath Roofing NC', 'total_claims' => 0, 'show_board' => true],
            ['name' => 'Luby Roofing', 'total_claims' => 1, 'show_board' => false],
            ['name' => 'Mr. Roof', 'total_claims' => 239, 'show_board' => true],
            ['name' => 'Ruffin Roofing', 'total_claims' => 86, 'show_board' => true],
            ['name' => 'Visionary Restoration', 'total_claims' => 1, 'show_board' => true],
        ];

        foreach ($locations as $location) {
            Location::updateOrCreate(['name' => $location['name']], $location);
        }
    }
}

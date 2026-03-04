<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    public function run(): void
    {
        $states = [
            ['name' => 'Alabama', 'code' => 'AL'],
            ['name' => 'Alaska', 'code' => 'AK'],
            ['name' => 'Arizona', 'code' => 'AZ'],
            ['name' => 'California', 'code' => 'CA'],
            ['name' => 'Colorado', 'code' => 'CO'],
            ['name' => 'Florida', 'code' => 'FL'],
            ['name' => 'Georgia', 'code' => 'GA'],
            ['name' => 'Illinois', 'code' => 'IL'],
            ['name' => 'New York', 'code' => 'NY'],
            ['name' => 'North Carolina', 'code' => 'NC'],
            ['name' => 'Ohio', 'code' => 'OH'],
            ['name' => 'Pennsylvania', 'code' => 'PA'],
            ['name' => 'Texas', 'code' => 'TX'],
            ['name' => 'Virginia', 'code' => 'VA'],
            ['name' => 'Washington', 'code' => 'WA'],
            ['name' => 'Wisconsin', 'code' => 'WI'],
        ];

        foreach ($states as $state) {
            State::updateOrCreate(['code' => $state['code']], $state);
        }
    }
}

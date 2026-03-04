<?php

namespace Database\Seeders;

use App\Models\SalesRepresentative;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalesRepresentativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records = [
            [
                'name' => 'Mike Forr',
                'number_of_leads' => 0,
                'trial_period' => '3 months',
                'link' => 'https://supptrax.com/subscriptions?id=MF69a5d9b2ee3f0',
            ],
            [
                'name' => 'remko bloemhard',
                'number_of_leads' => 3,
                'trial_period' => '3 months',
                'link' => 'https://supptrax.com/subscriptions?id=RB677bea5ecdc0f',
            ],
            [
                'name' => 'Remko Demo - 14 day Trial',
                'number_of_leads' => 1,
                'trial_period' => '14 days',
                'link' => 'https://supptrax.com/subscriptions?id=RR6718ec7ee0bd',
            ],
            [
                'name' => 'Becca Switzer',
                'number_of_leads' => 4,
                'trial_period' => '14 days',
                'link' => 'https://supptrax.com/subscriptions?id=B56718fa54652df',
            ],
            [
                'name' => 'David Hughes2',
                'number_of_leads' => 0,
                'trial_period' => '7 days',
                'link' => 'https://supptrax.com/subscriptions?id=DH689e3790420e7',
            ],
            [
                'name' => 'David Hughes1',
                'number_of_leads' => 0,
                'trial_period' => 'None',
                'link' => 'https://supptrax.com/subscriptions?id=DH689e37715ce3a',
            ],
            [
                'name' => 'ProLine 15% Discount',
                'number_of_leads' => 1,
                'trial_period' => 'None',
                'link' => 'https://supptrax.com/subscriptions?id=PD683417528310d',
            ],
            [
                'name' => 'John Dye',
                'number_of_leads' => 0,
                'trial_period' => '14 days',
                'link' => 'https://supptrax.com/subscriptions?id=JD6810da873540b',
            ],
            [
                'name' => 'LaMar Ruffin',
                'number_of_leads' => 0,
                'trial_period' => 'None',
                'link' => 'https://supptrax.com/subscriptions?id=LR681384a8a862b',
            ],
            [
                'name' => 'Sarah McGarvey',
                'number_of_leads' => 0,
                'trial_period' => 'None',
                'link' => 'https://supptrax.com/subscriptions?n=SM6788784483864',
            ],
            [
                'name' => 'Alex Kelly',
                'number_of_leads' => 0,
                'trial_period' => 'None',
                'link' => 'https://supptrax.com/subscriptions?n=AK678a77ca8c51a',
            ],
            [
                'name' => 'Becca Supplement Class',
                'number_of_leads' => 0,
                'trial_period' => '3 months',
                'link' => 'https://supptrax.com/subscriptions?n=9567740065682e',
            ],
            [
                'name' => 'Dyhilee Jasso',
                'number_of_leads' => 0,
                'trial_period' => 'None',
                'link' => 'https://supptrax.com/subscriptions?n=DJ676990f681e03',
            ],
            [
                'name' => 'Mike Abernathy',
                'number_of_leads' => 0,
                'trial_period' => 'None',
                'link' => 'https://supptrax.com/subscriptions?n=MA67631d91bcb32',
            ],
            [
                'name' => 'Natalija Naumcevska',
                'number_of_leads' => 0,
                'trial_period' => 'None',
                'link' => 'https://supptrax.com/subscriptions?n=NN0000000000000',
            ],
        ];

        foreach ($records as $record) {
            SalesRepresentative::updateOrCreate(
                ['name' => $record['name']],
                $record,
            );
        }
    }
}

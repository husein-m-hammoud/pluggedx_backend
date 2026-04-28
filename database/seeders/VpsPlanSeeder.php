<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VpsPlan;

class VpsPlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name' => 'VPS-1',
                'specs' => [
                    ['label' => 'vCPU',    'value' => '6 vCores'],
                    ['label' => 'RAM',     'value' => '12 GB RAM'],
                    ['label' => 'Storage', 'value' => '100 GB SSD NVMe + Up to 500 GB'],
                    ['label' => 'OS',      'value' => 'Windows 2022'],
                ],
                'highlighted' => false,
                'sort_order'  => 1,
            ],
            [
                'name' => 'VPS-2',
                'specs' => [
                    ['label' => 'vCPU',    'value' => '8 vCores'],
                    ['label' => 'RAM',     'value' => '24 GB RAM'],
                    ['label' => 'Storage', 'value' => '200 GB SSD NVMe + Up to 500 GB'],
                    ['label' => 'OS',      'value' => 'Windows 2022'],
                ],
                'highlighted' => true,
                'sort_order'  => 2,
            ],
            [
                'name' => 'VPS-3',
                'specs' => [
                    ['label' => 'vCPU',    'value' => '12 vCores'],
                    ['label' => 'RAM',     'value' => '48 GB RAM'],
                    ['label' => 'Storage', 'value' => '300 GB SSD NVMe + Up to 500 GB'],
                    ['label' => 'OS',      'value' => 'Windows 2022'],
                ],
                'highlighted' => false,
                'sort_order'  => 3,
            ],
            [
                'name' => 'VPS-4',
                'specs' => [
                    ['label' => 'vCPU',    'value' => '16 vCores'],
                    ['label' => 'RAM',     'value' => '64 GB RAM'],
                    ['label' => 'Storage', 'value' => '350 GB SSD NVMe + Up to 500 GB'],
                    ['label' => 'OS',      'value' => 'Windows 2022'],
                ],
                'highlighted' => false,
                'sort_order'  => 4,
            ],
        ];

        foreach ($plans as $plan) {
            VpsPlan::updateOrCreate(
                ['name' => $plan['name']],
                $plan
            );
        }
    }
}

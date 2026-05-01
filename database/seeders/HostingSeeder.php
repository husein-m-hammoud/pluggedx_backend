<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HostingCategory;
use App\Models\HostingPlan;

class HostingSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'category' => [
                    'name'       => 'VPS Plans',
                    'icon'       => 'Server',
                    'sort_order' => 1,
                ],
                'plans' => [
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
                ],
            ],
            [
                'category' => [
                    'name'       => 'Dedicated Servers',
                    'icon'       => 'Cpu',
                    'sort_order' => 2,
                ],
                'plans' => [
                    [
                        'name' => 'Offer 1',
                        'specs' => [
                            ['label' => 'CPU',     'value' => 'AMD EPYC 4244P'],
                            ['label' => 'RAM',     'value' => '32 GB'],
                            ['label' => 'Storage', 'value' => '2 × 960 GB SSD'],
                            ['label' => 'RAID',    'value' => 'Hardware-RAID 1'],
                            ['label' => 'OS',      'value' => 'Windows 2022'],
                        ],
                        'highlighted' => false,
                        'sort_order'  => 1,
                    ],
                    [
                        'name' => 'Offer 2',
                        'specs' => [
                            ['label' => 'CPU',     'value' => 'AMD EPYC 4344P'],
                            ['label' => 'RAM',     'value' => '64 GB'],
                            ['label' => 'Storage', 'value' => '2 × 960 GB SSD'],
                            ['label' => 'RAID',    'value' => 'Hardware-RAID 1'],
                            ['label' => 'OS',      'value' => 'Windows 2022'],
                        ],
                        'highlighted' => true,
                        'sort_order'  => 2,
                    ],
                    [
                        'name' => 'Offer 3',
                        'specs' => [
                            ['label' => 'CPU',     'value' => 'AMD EPYC 4345P'],
                            ['label' => 'RAM',     'value' => '256 GB'],
                            ['label' => 'Storage', 'value' => '2 × 960 GB SSD'],
                            ['label' => 'RAID',    'value' => 'Hardware-RAID 1'],
                            ['label' => 'OS',      'value' => 'Windows 2022'],
                        ],
                        'highlighted' => false,
                        'sort_order'  => 3,
                    ],
                ],
            ],
        ];

        foreach ($data as $entry) {
            $category = HostingCategory::updateOrCreate(
                ['name' => $entry['category']['name']],
                $entry['category']
            );

            foreach ($entry['plans'] as $plan) {
                HostingPlan::updateOrCreate(
                    ['category_id' => $category->id, 'name' => $plan['name']],
                    array_merge($plan, ['category_id' => $category->id])
                );
            }
        }
    }
}

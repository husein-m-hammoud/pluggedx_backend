<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DedicatedServer;

class DedicatedServerSeeder extends Seeder
{
    public function run(): void
    {
        $servers = [
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
        ];

        foreach ($servers as $server) {
            DedicatedServer::updateOrCreate(
                ['name' => $server['name']],
                $server
            );
        }
    }
}

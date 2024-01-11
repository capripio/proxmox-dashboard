<?php

namespace Database\Seeders;

use App\Models\IP;
use App\Models\ProxmoxServer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IP::create([
            'proxmox_server_id' => 1,
            'ip_address' => '66.23.201.230',
            'status' => 'available',
        ]);
    }
}

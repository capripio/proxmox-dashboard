<?php

namespace Database\Seeders;

use App\Models\ProxmoxServer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProxmoxServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProxmoxServer::create([
            'name' => 'Server 1',
            'ip_address' => '23.95.92.128',
            'token_id' => 'root@pam!test',
            'token_secret' => 'aa5be178-c2bb-44fa-8c60-227d8d79ee54',
        ]);
    }
}

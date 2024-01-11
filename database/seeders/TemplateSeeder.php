<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Template::create([
            'name' => 'Windows Tiny',
            'description' => 'Windows 10 Tiny',
            'proxmox_server_id' => 1,
            'vm_id' => 1999,
        ]);
    }
}

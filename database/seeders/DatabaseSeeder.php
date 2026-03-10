<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Equipment; // <--- DON'T FORGET THIS LINE!
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Item 1
        Equipment::create([
            'name' => 'MacBook Air M2',
            'serial_number' => 'MAC-88472',
            'type' => 'Laptop',
            'status' => 'Available'
        ]);

        // Item 2
        Equipment::create([
            'name' => 'Dell 27-inch 4K Monitor',
            'serial_number' => 'DEL-09938',
            'type' => 'Display',
            'status' => 'Available'
        ]);

        // Item 3
        Equipment::create([
            'name' => 'Sony A7III Camera',
            'serial_number' => 'SNY-11223',
            'type' => 'Camera',
            'status' => 'Checked Out' // Status checked out
        ]);

        // Item 4
        Equipment::create([
            'name' => 'Sony DMG Camera',
            'serial_number' => 'SNY-90283',
            'type' => 'Camera',
            'status' => 'Broken' // Status broken
        ]);

        Equipment::create([
            'name' => 'Macbook Air M1',
            'serial_number' => 'MAC-88923',
            'type' => 'Laptop',
            'status' => 'Checked Out'
        ]);

        // ITEM FOR THE REPAIR QUEUE #1
        Equipment::create([
            'name' => 'Sony A7III Camera',
            'serial_number' => 'SNY-92037',
            'type' => 'Camera',
            'status' => 'Broken',
            'repair_notes' => 'Cracked lens element; waiting on replacement glass from Sony.',
            'return_date' => '2026-03-25'
        ]);

        // ITEM FOR THE REPAIR QUEUE #2
        Equipment::create([
            'name' => 'iPad Pro 12.9',
            'serial_number' => 'IPD-44556',
            'type' => 'Tablet',
            'status' => 'Broken',
            'repair_notes' => 'Battery swelling; needs immediate replacement.',
            'return_date' => '2026-03-15'
        ]);
    }

}

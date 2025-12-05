<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderStatus;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderStatus::create([
            'status_name' => 'Bestellt',
        ]);
        
        OrderStatus::create([
            'status_name' => 'Bezahlt',
        ]);

        OrderStatus::create([
            'status_name' => 'In Arbeit',
        ]);
    }
}

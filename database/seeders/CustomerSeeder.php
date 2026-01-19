<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'prename' => 'Manuel',
            'surname' => 'Seifried',
            'adress_id' => '1',
            'email' => 'manuelseifried03@gmail.com',
            'telephonenumber' => '06608316655'
        ]);
    }
}

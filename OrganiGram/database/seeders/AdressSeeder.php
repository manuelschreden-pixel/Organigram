<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Adress;

class AdressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Adress::create([
            'street' => 'Oberrainz',
            'housenumber' => '19',
            'plz' => '9423',
            'town' => 'St.Georgen'
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\EmissionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmissionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmissionType::create([
            'name' => 'CO2',
            'description' => 'Carbon dioxide',
        ]);

        EmissionType::create([
            'name' => 'CH4',
            'description' => 'Methane',
        ]);

        EmissionType::create([
            'name' => 'N2O',
            'description' => 'Nitrous oxide',
        ]);
    }
}

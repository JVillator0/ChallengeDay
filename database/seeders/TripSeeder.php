<?php

namespace Database\Seeders;

use App\Models\Deparment;
use App\Models\EmissionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    public function run()
    {
        $co2 = EmissionType::where('name', 'CO2')->first(['id']);

        $ceo = Deparment::where('name', 'Junta directiva')->first(['id']);
        $ceo->trips()->createMany($this->createTrips($ceo->id, $co2->id, 3));

        $sales = Deparment::where('name', 'Ventas')->first(['id']);
        $sales->trips()->createMany($this->createTrips($sales->id, $co2->id, 2));
    }

    private function createTrips($deparmentId, $emissionTypeId, $frecuency)
    {
        $trips = collect();

        for ($i = 1; $i <= 12; $i++) {
            for ($j = 1; $j <= $frecuency; $j++) {
                $day = $j * 10;
                $trips->push([
                    'deparment_id' => $deparmentId,
                    'emission_type_id' => $emissionTypeId,
                    'trip_date' => ('2022-' . $i . '-' . ($i == 2 && $day > 28 ? '28' : $day))
                ]);
            }
        }

        return $trips;
    }
}

<?php

namespace Database\Seeders;

use App\Models\Place;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Place::create([
            'name' => 'Planta de envasado',
            'description' => 'planta de envasado de agua mineral',
            'address' => 'avenida 1, calle 2, sector 3, ciudad 4, estado 5, país 6',
            'location_url' => 'http://www.google.com',
        ]);

        Place::create([
            'name' => 'Almacen',
            'description' => 'Almacen',
            'address' => 'avenida 1, calle 2, sector 3, ciudad 4, estado 5, país 6',
            'location_url' => 'http://www.google.com',
        ]);

        Place::create([
            'name' => 'Oficina de administración',
            'description' => 'Oficina de administración',
            'address' => 'avenida 1, calle 2, sector 3, ciudad 4, estado 5, país 6',
            'location_url' => 'http://www.google.com',
        ]);
    }
}

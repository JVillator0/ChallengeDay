<?php

namespace Database\Seeders;

use App\Models\CategoryType;
use App\Models\EmissionType;
use App\Models\Place;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsumptionSeeder extends Seeder
{
    public function run()
    {
        $co2 = EmissionType::where('name', 'CO2')->first(['id']);
        $hfc = EmissionType::where('name', 'HFC')->first(['id']);

        // 1.
        $categoryType = CategoryType::query()
            ->whereHas('category', fn ($query) => $query->where('name', 'Administrativo'))
            ->whereHas('type', fn ($query) => $query->where('name', 'Combustible'))
            ->first(['id']);

        $place = Place::where('name', 'Oficina de administración')->first(['id']);

        $categoryType->consumptions()->createMany([
            [
                'amount' => 750,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-01-30',
                'updated_at' => '2022-01-30',
            ],
            [
                'amount' => 750,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-02-28',
                'updated_at' => '2022-02-28',
            ],
            [
                'amount' => 750,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-03-31',
                'updated_at' => '2022-03-31',
            ],
            [
                'amount' => rand(500, 1000),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-04-30',
                'updated_at' => '2022-04-30',
            ],
            [
                'amount' => rand(500, 1000),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-05-31',
                'updated_at' => '2022-05-31',
            ],
            [
                'amount' => rand(500, 1000),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-06-30',
                'updated_at' => '2022-06-30',
            ],
            [
                'amount' => rand(500, 1000),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-07-31',
                'updated_at' => '2022-07-31',
            ],
            [
                'amount' => rand(500, 1000),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-08-31',
                'updated_at' => '2022-08-31',
            ],
            [
                'amount' => rand(500, 1000),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-09-30',
                'updated_at' => '2022-09-30',
            ],
            [
                'amount' => rand(500, 1000),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-10-31',
                'updated_at' => '2022-10-31',
            ],
            [
                'amount' => rand(500, 1000),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-11-30',
                'updated_at' => '2022-11-30',
            ],
            [
                'amount' => rand(500, 1000),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-12-31',
                'updated_at' => '2022-12-31',
            ]
        ]);

        // 2.
        $categoryType = CategoryType::query()
            ->whereHas('category', fn ($query) => $query->where('name', 'Distribución'))
            ->whereHas('type', fn ($query) => $query->where('name', 'Refrigerante'))
            ->first(['id']);

        $place = Place::where('name', 'Planta de envasado')->first(['id']);

        $categoryType->consumptions()->createMany([
            [
                'amount' => 3,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-01-30',
                'updated_at' => '2022-01-30',
            ],
            [
                'amount' => 3,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-02-28',
                'updated_at' => '2022-02-28',
            ],
            [
                'amount' => 3,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-03-31',
                'updated_at' => '2022-03-31',
            ],
            [
                'amount' => rand(1, 5),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-04-30',
                'updated_at' => '2022-04-30',
            ],
            [
                'amount' => rand(1, 5),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-05-31',
                'updated_at' => '2022-05-31',
            ],
            [
                'amount' => rand(1, 5),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-06-30',
                'updated_at' => '2022-06-30',
            ],
            [
                'amount' => rand(1, 5),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-07-31',
                'updated_at' => '2022-07-31',
            ],
            [
                'amount' => rand(1, 5),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-08-31',
                'updated_at' => '2022-08-31',
            ],
            [
                'amount' => rand(1, 5),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-09-30',
                'updated_at' => '2022-09-30',
            ],
            [
                'amount' => rand(1, 5),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-10-31',
                'updated_at' => '2022-10-31',
            ],
            [
                'amount' => rand(1, 5),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-11-30',
                'updated_at' => '2022-11-30',
            ],
            [
                'amount' => rand(1, 5),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-12-31',
                'updated_at' => '2022-12-31',
            ],
        ]);

        // 3.
        $categoryType = CategoryType::query()
            ->whereHas('category', fn ($query) => $query->where('name', 'Administrativo'))
            ->whereHas('type', fn ($query) => $query->where('name', 'Electricidad'))
            ->first(['id']);

        $place = Place::where('name', 'Oficina de administración')->first(['id']);

        $categoryType->consumptions()->createMany([
            [
                'amount' => 300,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-01-30',
                'updated_at' => '2022-01-30',
            ],
            [
                'amount' => 300,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-02-28',
                'updated_at' => '2022-02-28',
            ],
            [
                'amount' => 300,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-03-31',
                'updated_at' => '2022-03-31',
            ],
            [
                'amount' => rand(200, 500),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-04-30',
                'updated_at' => '2022-04-30',
            ],
            [
                'amount' => rand(200, 500),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-05-31',
                'updated_at' => '2022-05-31',
            ],
            [
                'amount' => rand(200, 500),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-06-30',
                'updated_at' => '2022-06-30',
            ],
            [
                'amount' => rand(200, 500),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-07-31',
                'updated_at' => '2022-07-31',
            ],
            [
                'amount' => rand(200, 500),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-08-31',
                'updated_at' => '2022-08-31',
            ],
            [
                'amount' => rand(200, 500),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-09-30',
                'updated_at' => '2022-09-30',
            ],
            [
                'amount' => rand(200, 500),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-10-31',
                'updated_at' => '2022-10-31',
            ],
            [
                'amount' => rand(200, 500),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-11-30',
                'updated_at' => '2022-11-30',
            ],
            [
                'amount' => rand(200, 500),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-12-31',
                'updated_at' => '2022-12-31',
            ],
        ]);

        // 4.
        $categoryType = CategoryType::query()
            ->whereHas('category', fn ($query) => $query->where('name', 'Distribución'))
            ->whereHas('type', fn ($query) => $query->where('name', 'Combustible'))
            ->first(['id']);

        if (!$categoryType) {
            info('No se encontró el tipo de consumo "Combustible" en la categoría "Distribución"');
        }

        $place = Place::where('name', 'Planta de envasado')->first(['id']);

        $categoryType->consumptions()->createMany([
            [
                'amount' => 1250,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-01-30',
                'updated_at' => '2022-01-30',
            ],
            [
                'amount' => 1250,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-02-28',
                'updated_at' => '2022-02-28',
            ],
            [
                'amount' => 1250,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-03-31',
                'updated_at' => '2022-03-31',
            ],
            [
                'amount' => rand(1000, 1500),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-04-30',
                'updated_at' => '2022-04-30',
            ],
            [
                'amount' => rand(1000, 1500),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-05-31',
                'updated_at' => '2022-05-31',
            ],
            [
                'amount' => rand(1000, 1500),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-06-30',
                'updated_at' => '2022-06-30',
            ],
            [
                'amount' => rand(1000, 1500),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-07-31',
                'updated_at' => '2022-07-31',
            ],
            [
                'amount' => rand(1000, 1500),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-08-31',
                'updated_at' => '2022-08-31',
            ],
            [
                'amount' => rand(1000, 1500),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-09-30',
                'updated_at' => '2022-09-30',
            ],
            [
                'amount' => rand(1000, 1500),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-10-31',
                'updated_at' => '2022-10-31',
            ],
            [
                'amount' => rand(1000, 1500),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-11-30',
                'updated_at' => '2022-11-30',
            ],
            [
                'amount' => rand(1000, 1500),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-12-31',
                'updated_at' => '2022-12-31',
            ],
        ]);

        // 5.
        $categoryType = CategoryType::query()
            ->whereHas('category', fn ($query) => $query->where('name', 'Indirecto de proveedor'))
            ->whereHas('type', fn ($query) => $query->where('name', 'Combustible'))
            ->first(['id']);

        $place = Place::where('name', 'Planta de envasado')->first(['id']);

        $categoryType->consumptions()->createMany([
            [
                'amount' => 500,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-01-30',
                'updated_at' => '2022-01-30',
            ],
            [
                'amount' => 500,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-02-28',
                'updated_at' => '2022-02-28',
            ],
            [
                'amount' => 500,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-03-31',
                'updated_at' => '2022-03-31',
            ],
            [
                'amount' => rand(250, 750),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-04-30',
                'updated_at' => '2022-04-30',
            ],
            [
                'amount' => rand(250, 750),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-05-31',
                'updated_at' => '2022-05-31',
            ],
            [
                'amount' => rand(250, 750),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-06-30',
                'updated_at' => '2022-06-30',
            ],
            [
                'amount' => rand(250, 750),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-07-31',
                'updated_at' => '2022-07-31',
            ],
            [
                'amount' => rand(250, 750),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-08-31',
                'updated_at' => '2022-08-31',
            ],
            [
                'amount' => rand(250, 750),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-09-30',
                'updated_at' => '2022-09-30',
            ],
            [
                'amount' => rand(250, 750),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-10-31',
                'updated_at' => '2022-10-31',
            ],
            [
                'amount' => rand(250, 750),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-11-30',
                'updated_at' => '2022-11-30',
            ],
            [
                'amount' => rand(250, 750),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-12-31',
                'updated_at' => '2022-12-31',
            ],
        ]);

        // 6. Made in TripSeeder

        // 7.
        $categoryType = CategoryType::query()
            ->whereHas('category', fn ($query) => $query->where('name', 'Operación'))
            ->whereHas('type', fn ($query) => $query->where('name', 'Aceite'))
            ->first(['id']);

        $place = Place::where('name', 'Planta de envasado')->first(['id']);

        $categoryType->consumptions()->createMany([
            [
                'amount' => 900,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-01-30',
                'updated_at' => '2022-01-30',
            ],
            [
                'amount' => 900,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-02-28',
                'updated_at' => '2022-02-28',
            ],
            [
                'amount' => 900,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-03-31',
                'updated_at' => '2022-03-31',
            ],
            [
                'amount' => rand(700, 1100),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-04-30',
                'updated_at' => '2022-04-30',
            ],
            [
                'amount' => rand(700, 1100),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-05-31',
                'updated_at' => '2022-05-31',
            ],
            [
                'amount' => rand(700, 1100),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-06-30',
                'updated_at' => '2022-06-30',
            ],
            [
                'amount' => rand(700, 1100),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-07-31',
                'updated_at' => '2022-07-31',
            ],
            [
                'amount' => rand(700, 1100),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-08-31',
                'updated_at' => '2022-08-31',
            ],
            [
                'amount' => rand(700, 1100),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-09-30',
                'updated_at' => '2022-09-30',
            ],
            [
                'amount' => rand(700, 1100),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-10-31',
                'updated_at' => '2022-10-31',
            ],
            [
                'amount' => rand(700, 1100),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-11-30',
                'updated_at' => '2022-11-30',
            ],
            [
                'amount' => rand(700, 1100),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-12-31',
                'updated_at' => '2022-12-31',
            ],
        ]);

        // 8.
        $categoryType = CategoryType::query()
            ->whereHas('category', fn ($query) => $query->where('name', 'Operación'))
            ->whereHas('type', fn ($query) => $query->where('name', 'Electricidad'))
            ->first(['id']);

        $place = Place::where('name', 'Planta de envasado')->first(['id']);

        $categoryType->consumptions()->createMany([
            [
                'amount' => 900,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-01-30',
                'updated_at' => '2022-01-30',
            ],
            [
                'amount' => 900,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-02-28',
                'updated_at' => '2022-02-28',
            ],
            [
                'amount' => 900,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-03-31',
                'updated_at' => '2022-03-31',
            ],
            [
                'amount' => rand(700, 1100),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-04-30',
                'updated_at' => '2022-04-30',
            ],
            [
                'amount' => rand(700, 1100),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-05-31',
                'updated_at' => '2022-05-31',
            ],
            [
                'amount' => rand(700, 1100),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-06-30',
                'updated_at' => '2022-06-30',
            ],
            [
                'amount' => rand(700, 1100),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-07-31',
                'updated_at' => '2022-07-31',
            ],
            [
                'amount' => rand(700, 1100),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-08-31',
                'updated_at' => '2022-08-31',
            ],
            [
                'amount' => rand(700, 1100),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-09-30',
                'updated_at' => '2022-09-30',
            ],
            [
                'amount' => rand(700, 1100),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-10-31',
                'updated_at' => '2022-10-31',
            ],
            [
                'amount' => rand(700, 1100),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-11-30',
                'updated_at' => '2022-11-30',
            ],
            [
                'amount' => rand(700, 1100),
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-12-31',
                'updated_at' => '2022-12-31',
            ],
        ]);

        // 9.

        $categoryType = CategoryType::query()
            ->whereHas('category', fn ($query) => $query->where('name', 'Distribución'))
            ->whereHas('type', fn ($query) => $query->where('name', 'Aceite'))
            ->first(['id']);

        $place = Place::where('name', 'Planta de envasado')->first(['id']);

        $categoryType->consumptions()->createMany([
            [
                'amount' => 30,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-01-30',
                'updated_at' => '2022-01-30',
            ],
            [
                'amount' => 28,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-02-28',
                'updated_at' => '2022-02-28',
            ],
            [
                'amount' => 31,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-03-31',
                'updated_at' => '2022-03-31',
            ],
            [
                'amount' => 30,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-04-30',
                'updated_at' => '2022-04-30',
            ],
            [
                'amount' => 31,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-05-31',
                'updated_at' => '2022-05-31',
            ],
            [
                'amount' => 30,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-06-30',
                'updated_at' => '2022-06-30',
            ],
            [
                'amount' => 31,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-07-31',
                'updated_at' => '2022-07-31',
            ],
            [
                'amount' => 30,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-08-31',
                'updated_at' => '2022-08-31',
            ],
            [
                'amount' => 30,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-09-30',
                'updated_at' => '2022-09-30',
            ],
            [
                'amount' => 31,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-10-31',
                'updated_at' => '2022-10-31',
            ],
            [
                'amount' => 30,
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-11-30',
                'updated_at' => '2022-11-30',
            ],
            [
                'amount' => 29, // for holidays
                'emission_type_id' => $co2->id,
                'place_id' => $place->id,
                'created_at' => '2022-12-31',
                'updated_at' => '2022-12-31',
            ],
        ]);

        // 10.
        $categoryType = CategoryType::query()
            ->whereHas('category', fn ($query) => $query->where('name', 'Administrativo'))
            ->whereHas('type', fn ($query) => $query->where('name', 'Papel Bond'))
            ->first(['id']);

        $place = Place::where('name', 'Oficina de administración')->first(['id']);

        $categoryType->consumptions()->createMany([
            [
                'amount' => 300,
                'emission_type_id' => $hfc->id,
                'place_id' => $place->id,
                'created_at' => '2022-01-30',
                'updated_at' => '2022-01-30',
            ],
            [
                'amount' => 300,
                'emission_type_id' => $hfc->id,
                'place_id' => $place->id,
                'created_at' => '2022-02-28',
                'updated_at' => '2022-02-28',
            ],
            [
                'amount' => 300,
                'emission_type_id' => $hfc->id,
                'place_id' => $place->id,
                'created_at' => '2022-03-31',
                'updated_at' => '2022-03-31',
            ],
            [
                'amount' => rand(250, 350),
                'emission_type_id' => $hfc->id,
                'place_id' => $place->id,
                'created_at' => '2022-04-30',
                'updated_at' => '2022-04-30',
            ],
            [
                'amount' => rand(250, 350),
                'emission_type_id' => $hfc->id,
                'place_id' => $place->id,
                'created_at' => '2022-05-31',
                'updated_at' => '2022-05-31',
            ],
            [
                'amount' => rand(250, 350),
                'emission_type_id' => $hfc->id,
                'place_id' => $place->id,
                'created_at' => '2022-06-30',
                'updated_at' => '2022-06-30',
            ],
            [
                'amount' => rand(250, 350),
                'emission_type_id' => $hfc->id,
                'place_id' => $place->id,
                'created_at' => '2022-07-31',
                'updated_at' => '2022-07-31',
            ],
            [
                'amount' => rand(250, 350),
                'emission_type_id' => $hfc->id,
                'place_id' => $place->id,
                'created_at' => '2022-08-31',
                'updated_at' => '2022-08-31',
            ],
            [
                'amount' => rand(250, 350),
                'emission_type_id' => $hfc->id,
                'place_id' => $place->id,
                'created_at' => '2022-09-30',
                'updated_at' => '2022-09-30',
            ],
            [
                'amount' => rand(250, 350),
                'emission_type_id' => $hfc->id,
                'place_id' => $place->id,
                'created_at' => '2022-10-31',
                'updated_at' => '2022-10-31',
            ],
            [
                'amount' => rand(250, 350),
                'emission_type_id' => $hfc->id,
                'place_id' => $place->id,
                'created_at' => '2022-11-30',
                'updated_at' => '2022-11-30',
            ],
            [
                'amount' => rand(250, 350),
                'emission_type_id' => $hfc->id,
                'place_id' => $place->id,
                'created_at' => '2022-12-31',
                'updated_at' => '2022-12-31',
            ],
        ]);
    }
}

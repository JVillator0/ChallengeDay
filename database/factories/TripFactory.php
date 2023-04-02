<?php

namespace Database\Factories;

use App\Models\Deparment;
use App\Models\EmissionType;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'deparment_id' => Deparment::factory(),
            'emission_type_id' => EmissionType::factory(),
            'trip_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Trip $trip) {
            $trip->deparment()->associate(Deparment::all()->random());
            $trip->emissionType()->associate(EmissionType::all()->random());
            $trip->save();
        });
    }
}

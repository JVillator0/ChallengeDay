<?php

namespace Database\Factories;

use App\Models\CategoryType;
use App\Models\Consumption;
use App\Models\EmissionType;
use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consumption>
 */
class ConsumptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'amount' => $this->faker->randomFloat(2, 0, 100),
            'category_type_id' => CategoryType::factory(),
            'emission_type_id' => EmissionType::factory(),
            'place_id' => Place::factory(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Consumption $consumption) {
            $consumption->categoryType()->associate(CategoryType::all()->random());
            $consumption->emissionType()->associate(EmissionType::all()->random());
            $consumption->place()->associate(Place::all()->random());
            $consumption->save();
        });
    }
}

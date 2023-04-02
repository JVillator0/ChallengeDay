<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoryType>
 */
class CategoryTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_id' => Category::factory(),
            'type_id' => Type::factory(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (CategoryType $categoryType) {
            $categoryType->category()->associate(Category::all()->random());
            $categoryType->type()->associate(Type::all()->random());
            $categoryType->save();
        });
    }
}

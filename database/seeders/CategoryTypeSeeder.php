<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Categories
        Category::create([
            'name' => 'Administrativo',
            'description' => 'Consumos con fines administrativos',
        ]);

        Category::create([
            'name' => 'Indirecto de proveedor',
            'description' => 'Consumos indirectos de proveedor',
        ]);

        Category::create([
            'name' => 'Logística',
            'description' => 'Consumos con fines logísticos',
        ]);

        Category::create([
            'name' => 'Distribución',
            'description' => 'Consumos con fines de distribución',
        ]);

        Category::create([
            'name' => 'Operación',
            'description' => 'Consumos con fines de operación',
        ]);

        // Types
        Type::create([
            'name' => 'Combustible',
            'description' => 'Combustible',
        ]);

        Type::create([
            'name' => 'Electricidad',
            'description' => 'Electricidad',
        ]);

        Type::create([
            'name' => 'Otros productos derivados del petróleo',
            'description' => 'Otros productos derivados del petróleo',
        ]);

        // Fuel
        $typeId = Type::where('name', 'Combustible')->value('id');
        CategoryType::create([
            'category_id' => Category::where('name', 'Administrativo')->value('id'),
            'type_id' => $typeId,
        ]);

        CategoryType::create([
            'category_id' => Category::where('name', 'Indirecto de proveedor')->value('id'),
            'type_id' => $typeId,
        ]);

        CategoryType::create([
            'category_id' => Category::where('name', 'Logística')->value('id'),
            'type_id' => $typeId,
        ]);

        // Electricity
        $typeId = Type::where('name', 'Electricidad')->value('id');
        CategoryType::create([
            'category_id' => Category::where('name', 'Administrativo')->value('id'),
            'type_id' => $typeId,
        ]);

        CategoryType::create([
            'category_id' => Category::where('name', 'Logística')->value('id'),
            'type_id' => $typeId,
        ]);

        CategoryType::create([
            'category_id' => Category::where('name', 'Distribución')->value('id'),
            'type_id' => $typeId,
        ]);

        // Other petroleum products
        $typeId = Type::where('name', 'Otros productos derivados del petróleo')->value('id');
        CategoryType::create([
            'category_id' => Category::where('name', 'Administrativo')->value('id'),
            'type_id' => $typeId,
        ]);

        CategoryType::create([
            'category_id' => Category::where('name', 'Logística')->value('id'),
            'type_id' => $typeId,
        ]);

        CategoryType::create([
            'category_id' => Category::where('name', 'Operación')->value('id'),
            'type_id' => $typeId,
        ]);
    }
}

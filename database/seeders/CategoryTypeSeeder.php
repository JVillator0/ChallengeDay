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
            'unit' => 'Galones',
            'unit_abbreviation' => 'gal',
        ]);

        Type::create([
            'name' => 'Electricidad',
            'description' => 'Electricidad',
            'unit' => 'Kilowatts',
            'unit_abbreviation' => 'kW',
        ]);

        Type::create([
            'name' => 'Aceite',
            'description' => 'Aceite para motores',
            'unit' => 'Galones',
            'unit_abbreviation' => 'gal',
        ]);

        Type::create([
            'name' => 'Papel Bond',
            'description' => 'Papel Bond',
            'unit' => 'Unidades',
            'unit_abbreviation' => 'u',
        ]);

        Type::create([
            'name' => 'Refrigerante',
            'description' => 'Refrigerante',
            'unit' => 'Litros',
            'unit_abbreviation' => 'l',
        ]);


        $administration = Category::where('name', 'Administrativo')->value('id');
        $supplier =  Category::where('name', 'Indirecto de proveedor')->value('id');
        $logistics = Category::where('name', 'Logística')->value('id');
        $distribution = Category::where('name', 'Distribución')->value('id');
        $operation = Category::where('name', 'Operación')->value('id');

        // Fuel
        $typeId = Type::where('name', 'Combustible')->value('id');
        CategoryType::create([
            'category_id' => $administration,
            'type_id' => $typeId,
        ]);

        CategoryType::create([
            'category_id' => $supplier,
            'type_id' => $typeId,
        ]);

        CategoryType::create([
            'category_id' => $logistics,
            'type_id' => $typeId,
        ]);

        CategoryType::create([
            'category_id' => $distribution,
            'type_id' => $typeId,
        ]);

        // Electricity
        $typeId = Type::where('name', 'Electricidad')->value('id');
        CategoryType::create([
            'category_id' => $administration,
            'type_id' => $typeId,
        ]);

        CategoryType::create([
            'category_id' => $supplier,
            'type_id' => $typeId,
        ]);

        CategoryType::create([
            'category_id' => $distribution,
            'type_id' => $typeId,
        ]);

        CategoryType::create([
            'category_id' => $operation,
            'type_id' => $typeId,
        ]);

        $typeId = Type::where('name', 'Aceite')->value('id');
        CategoryType::create([
            'category_id' => $administration,
            'type_id' => $typeId,
        ]);

        CategoryType::create([
            'category_id' => $supplier,
            'type_id' => $typeId,
        ]);

        CategoryType::create([
            'category_id' => $logistics,
            'type_id' => $typeId,
        ]);

        CategoryType::create([
            'category_id' => $operation,
            'type_id' => $typeId,
        ]);

        CategoryType::create([
            'category_id' => $distribution,
            'type_id' => $typeId,
        ]);

        $typeId = Type::where('name', 'Papel Bond')->value('id');
        CategoryType::create([
            'category_id' => $administration,
            'type_id' => $typeId,
        ]);

        CategoryType::create([
            'category_id' => $supplier,
            'type_id' => $typeId,
        ]);

        CategoryType::create([
            'category_id' => $operation,
            'type_id' => $typeId,
        ]);

        $typeId = Type::where('name', 'Refrigerante')->value('id');
        CategoryType::create([
            'category_id' => $distribution,
            'type_id' => $typeId,
        ]);
    }
}

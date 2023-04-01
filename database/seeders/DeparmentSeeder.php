<?php

namespace Database\Seeders;

use App\Models\Deparment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeparmentSeeder extends Seeder
{
    public function run()
    {
        Deparment::create([
            'name' => 'Junta directiva',
            'description' => 'Junta directiva de la empresa, CEO y COO',
        ]);

        Deparment::create([
            'name' => 'Administración',
            'description' => 'Departamento de administración',
        ]);

        Deparment::create([
            'name' => 'Ventas',
            'description' => 'Departamento de ventas',
        ]);
    }
}

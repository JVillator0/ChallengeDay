<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        Department::create([
            'name' => 'Junta directiva',
            'description' => 'Junta directiva de la empresa, CEO y COO',
        ]);

        Department::create([
            'name' => 'Administración',
            'description' => 'Departamento de administración',
        ]);

        Department::create([
            'name' => 'Ventas',
            'description' => 'Departamento de ventas',
        ]);
    }
}

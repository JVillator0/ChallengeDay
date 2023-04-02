<?php

namespace App\Http\Controllers;

use App\Http\Requests\Department\StoreRequest;
use App\Http\Requests\Department\UpdateRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        return $this->success(
            'Departamentos listados correctamente',
            DepartmentResource::collection(Department::all())
        );
    }

    public function store(StoreRequest $request)
    {
        $department = Department::create($request->all());

        return $this->success(
            'Departamento creado correctamente',
            new DepartmentResource($department),
            201
        );
    }

    public function show(Department $department)
    {
        return $this->success(
            'Departamento listado correctamente',
            new DepartmentResource($department)
        );
    }

    public function update(UpdateRequest $request, Department $department)
    {
        $department->update($request->all());

        return $this->success(
            'Departamento actualizado correctamente',
            new DepartmentResource($department)
        );
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return $this->success(
            'Departamento eliminado correctamente',
            null,
            204
        );
    }
}

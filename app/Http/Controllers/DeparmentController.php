<?php

namespace App\Http\Controllers;

use App\Http\Requests\Deparment\StoreRequest;
use App\Http\Requests\Deparment\UpdateRequest;
use App\Http\Resources\DeparmentResource;
use App\Models\Deparment;
use Illuminate\Http\Request;

class DeparmentController extends Controller
{
    public function index()
    {
        return $this->success(
            'Departamentos listados correctamente',
            DeparmentResource::collection(Deparment::all())
        );
    }

    public function store(StoreRequest $request)
    {
        $deparment = Deparment::create($request->all());

        return $this->success(
            'Departamento creado correctamente',
            new DeparmentResource($deparment)
        );
    }

    public function show(Deparment $deparment)
    {
        return $this->success(
            'Departamento listado correctamente',
            new DeparmentResource($deparment)
        );
    }

    public function update(UpdateRequest $request, Deparment $deparment)
    {
        $deparment->update($request->all());

        return $this->success(
            'Departamento actualizado correctamente',
            new DeparmentResource($deparment)
        );
    }

    public function destroy(Deparment $deparment)
    {
        $deparment->delete();

        return $this->success(
            'Departamento eliminado correctamente',
            new DeparmentResource($deparment)
        );
    }
}

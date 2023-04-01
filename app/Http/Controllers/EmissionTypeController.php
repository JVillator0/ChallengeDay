<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmissionType\StoreRequest;
use App\Http\Requests\EmissionType\UpdateRequest;
use App\Http\Resources\EmissionTypeResource;
use App\Models\EmissionType;

class EmissionTypeController extends Controller
{
    public function index()
    {
        return $this->success(
            'Tipos de emisiones',
            EmissionTypeResource::collection(EmissionType::all())
        );
    }

    public function store(StoreRequest $request)
    {
        $emissionType = EmissionType::create($request->all());

        return $this->success(
            'Tipo de emision creado',
            new EmissionTypeResource($emissionType)
        );
    }

    public function show(EmissionType $emissionType)
    {
        return $this->success(
            'Categoria de consumo',
            new EmissionTypeResource($emissionType)
        );
    }

    public function update(UpdateRequest $request, EmissionType $emissionType)
    {
        $emissionType->update($request->all());

        return $this->success(
            'Tipo de emision actualizado',
            new EmissionTypeResource($emissionType)
        );
    }

    public function destroy(EmissionType $emissionType)
    {
        $emissionType->delete();

        return $this->success(
            'Tipo de emision eliminado',
        );
    }
}

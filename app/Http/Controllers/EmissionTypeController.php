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
            new EmissionTypeResource($emissionType),
            201
        );
    }

    public function show(EmissionType $emissions_type)
    {
        return $this->success(
            'Categoria de consumo',
            new EmissionTypeResource($emissions_type)
        );
    }

    public function update(UpdateRequest $request, EmissionType $emissions_type)
    {
        $emissions_type->update($request->all());

        return $this->success(
            'Tipo de emision actualizado',
            new EmissionTypeResource($emissions_type)
        );
    }

    public function destroy(EmissionType $emissions_type)
    {
        $emissions_type->delete();

        return $this->success(
            'Tipo de emision eliminado',
            null,
            204
        );
    }
}

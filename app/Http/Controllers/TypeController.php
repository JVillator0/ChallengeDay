<?php

namespace App\Http\Controllers;

use App\Http\Requests\Type\StoreRequest;
use App\Http\Requests\Type\UpdateRequest;
use App\Http\Resources\TypeResource;
use App\Models\Type;

class TypeController extends Controller
{
    public function index()
    {
        return $this->success(
            'Tipos de consumos',
            TypeResource::collection(Type::all())
        );
    }

    public function store(StoreRequest $request)
    {
        $type = Type::create($request->all());

        return $this->success(
            'Tipo de consumo creado',
            new TypeResource($type)
        );
    }

    public function show(Type $type)
    {
        return $this->success(
            'Tipo de consumo',
            new TypeResource($type)
        );
    }

    public function update(UpdateRequest $request, Type $type)
    {
        $type->update($request->all());

        return $this->success(
            'Tipo de consumo actualizado',
            new TypeResource($type)
        );
    }

    public function destroy(Type $type)
    {
        $type->delete();

        return $this->success(
            'Tipo de consumo eliminado',
        );
    }
}

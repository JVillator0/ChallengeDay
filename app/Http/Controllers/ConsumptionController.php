<?php

namespace App\Http\Controllers;

use App\Http\Requests\Consumption\StoreRequest;
use App\Http\Requests\Consumption\UpdateRequest;
use App\Http\Resources\ConsumptionResource;
use App\Models\Consumption;

class ConsumptionController extends Controller
{
    public function index()
    {
        return $this->success(
            'Lista de consumos',
            ConsumptionResource::collection(
                Consumption::with(['categoryType', 'emissionType', 'place'])->get()
            )
        );
    }

    public function store(StoreRequest $request)
    {
        $consumption = Consumption::create($request->all());

        return $this->success(
            'Consumo creado',
            new ConsumptionResource($consumption)
        );
    }

    public function show(Consumption $consumption)
    {
        return $this->success(
            'Consumo',
            new ConsumptionResource($consumption)
        );
    }

    public function update(UpdateRequest $request, Consumption $consumption)
    {
        $consumption->update($request->all());

        return $this->success(
            'Consumo actualizado',
            new ConsumptionResource($consumption)
        );
    }

    public function destroy(Consumption $consumption)
    {
        $consumption->delete();

        return $this->success(
            'Consumo eliminado',
        );
    }
}

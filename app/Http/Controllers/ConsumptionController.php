<?php

namespace App\Http\Controllers;

use App\Http\Requests\Consumption\StoreRequest;
use App\Http\Requests\Consumption\UpdateRequest;
use App\Http\Resources\ConsumptionResource;
use App\Models\Consumption;
use App\Models\Type;

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

    public function monthlyAverageFuelConsumption()
    {
        $results = Consumption::query()
            ->whereHas('categoryType.type', fn ($query) => $query->where('name', 'Combustible'))
            ->whereYear('created_at', 2022)
            ->selectRaw('MONTH(created_at) as month, AVG(amount) as average')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $typeAbbr = Type::where('name', 'Combustible')->value('unit_abbreviation');

        return $this->success(
            'Consumo promedio mensual de combustible',
            $results->map(
                fn ($item) =>
                [
                    'month' => $item->month,
                    'average' => round($item->average, 2),
                    'unit' => $typeAbbr,
                ]
            )
        );
    }
}

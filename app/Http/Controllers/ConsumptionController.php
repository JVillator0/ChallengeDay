<?php

namespace App\Http\Controllers;

use App\Http\Requests\Consumption\StoreRequest;
use App\Http\Requests\Consumption\UpdateRequest;
use App\Http\Resources\ConsumptionResource;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Consumption;
use App\Models\Place;
use App\Models\Type;
use Illuminate\Http\Request;

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

    // -----------------------------------------------------------------------
    // Metrics
    // -----------------------------------------------------------------------

    public function monthlyAverageFuelConsumption()
    {
        $results = Consumption::query()
            ->whereHas('categoryType.type', fn ($query) => $query->where('name', 'Combustible'))
            ->selectRaw('MONTH(created_at) as month, AVG(amount) as average')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $typeAbbr = Type::where('name', 'Combustible')->value('unit_abbreviation');

        return $this->success(
            'Consumo promedio mensual de combustible',
            [
                'average' => round($results->average('average'), 2),
                'unit' => $typeAbbr,
            ]
        );
    }

    public function mostImpactSegment()
    {
        $result = Category::query()
            ->with(['categoryTypes.consumptions' => function ($query) {
                $query->selectRaw('category_type_id, AVG(amount) as average_consumption')
                    ->groupBy('category_type_id');
            }])
            ->get(['id', 'name']);

        $result = $result->map(function ($item) {
            $totalConsumption = $item->categoryTypes->sum(function ($categoryType) {
                return $categoryType->consumptions[0]->average_consumption ?? 0;
            });

            return [
                'category' => $item->name,
                'average' => round($totalConsumption, 2),
            ];
        })
        ->sortByDesc('average')
        ->values();

        $total = $result->sum('average');

        return $this->success(
            'Segmento con mayor impacto',
            $result->map(
                fn ($item) => [
                    'category' => $item['category'],
                    'average' => $item['average'],
                    'percentage' => ($total > 0 ? round($item['average'] / $total * 100, 2) . '%' : '0%'),
                ]
            )
        );
    }

    public function monthlyAverageElectricityConsumption(Request $request)
    {
        $result = Place::query()
            ->when($request->has('place_id'), fn ($query) => $query->where('id', $request->place_id))
            ->with(['consumptions' => function ($query) {
                $query->selectRaw('place_id, MONTH(created_at) as month, AVG(amount) as average_consumption')
                    ->whereHas('categoryType.type', fn ($query) => $query->where('name', 'Electricidad'))
                    ->groupBy('place_id', 'month')
                    ->orderBy('month');
            }])
            ->get(['id', 'name']);

        $typeAbbr = Type::where('name', 'Electricidad')->value('unit_abbreviation');

        return $this->success(
            'Consumo promedio mensual de electricidad',
            $result->map(
                fn ($item) => [
                    'place' => $item->name,
                    'average' => round($item->consumptions->avg('average_consumption'), 2),
                    'unit' => $typeAbbr,
                ]
            )
        );
    }

    public function monthlyComparisonElectricityFuelConsumption()
    {
        $results = Consumption::query()
            ->whereHas('categoryType.type', fn ($query) => $query->where('name', 'Combustible'))
            ->selectRaw('MONTH(created_at) as month, AVG(amount) as average')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $fuel = $results->average('average');

        $results = Consumption::query()
            ->whereHas('categoryType.type', fn ($query) => $query->where('name', 'Electricidad'))
            ->selectRaw('MONTH(created_at) as month, AVG(amount) as average')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $electricity = $results->average('average');

        $total = $fuel + $electricity;

        return $this->success(
            'Porcentaje de consumo promedio mensual de combustible y electricidad',
            [
                'fuel' => round($fuel, 2),
                'electricity' => round($electricity, 2),
                'fuel_percentage' => ($total > 0 ? round($fuel / $total * 100, 2) . '%' : '0%'),
                'electricity_percentage' => ($total > 0 ? round($electricity / $total * 100, 2) . '%' : '0%'),
            ]
        );
    }

    public function monthlyAverageProductsConsumptionByType(Request $request)
    {
        $result = Type::query()
            ->when($request->has('type_ids'), fn ($query) => $query->whereIn('id', json_decode($request->type_ids)))
            ->with(['categoryTypes.consumptions' => function ($query) {
                $query->selectRaw('category_type_id, MONTH(created_at) as month, AVG(amount) as average_consumption')
                    ->groupBy('category_type_id', 'month')
                    ->orderBy('month');
            }])
            ->get(['id', 'name', 'unit_abbreviation']);

        $result = $result->map(function ($item) {
            $totalConsumption = $item->categoryTypes->avg(function ($categoryType) {
                return $categoryType->consumptions->avg('average_consumption') ?? 0;
            });

            return [
                'type' => $item->name,
                'average' => round($totalConsumption, 2),
                'unit_abbreviation' => $item->unit_abbreviation,
            ];
        })
        ->sortByDesc('average')
        ->values();

        $total = $result->sum('average');

        return $this->success(
            'Consumo promedio mensual de productos por tipo',
            $result->map(
                fn ($item) => [
                    'type' => $item['type'],
                    'average' => $item['average'],
                    'percentage' => ($total > 0 ? round($item['average'] / $total * 100, 2) . '%' : '0%'),
                    'unit' => $item['unit_abbreviation'],
                ]
            )
        );
    }
}

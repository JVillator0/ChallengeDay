<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryType\StoreRequest;
use App\Http\Requests\CategoryType\UpdateRequest;
use App\Http\Resources\CategoryTypeResource;
use App\Models\CategoryType;
use Illuminate\Http\Request;

class CategoryTypeController extends Controller
{
    // add query params to the index method, to filter by category and type by id
    public function index(Request $request)
    {
        $results = CategoryType::query()
            ->when($request->has('category_id'), function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })
            ->when($request->has('type_id'), function ($query) use ($request) {
                $query->where('type_id', $request->type_id);
            })
            ->get();

        return $this->success(
            'Tipos de categorias',
            CategoryTypeResource::collection($results)
        );
    }

    public function store(StoreRequest $request)
    {
        $type = CategoryType::create($request->all());

        return $this->success(
            'Categoria de consumo creada',
            new CategoryTypeResource($type),
            201
        );
    }

    public function show(CategoryType $category_type)
    {
        return $this->success(
            'Categoria de consumo',
            new CategoryTypeResource($category_type)
        );
    }

    public function update(UpdateRequest $request, CategoryType $category_type)
    {
        $category_type->update($request->all());

        return $this->success(
            'Categoria de consumo actualizada',
            new CategoryTypeResource($category_type)
        );
    }

    public function destroy(CategoryType $category_type)
    {
        $category_type->delete();

        return $this->success(
            'Categoria de consumo eliminada',
            null,
            204
        );
    }

    // -----------------------------------------------------------------------
    // Metrics
    // -----------------------------------------------------------------------

    public function anualAverageFuelConsumptionByCategory()
    {
        $result = CategoryType::query()
            ->whereHas('consumptions')
            ->whereHas('type', function ($query) {
                $query->where('name', 'Combustible');
            })
            ->with(['consumptions' => function ($query) {
                $query->selectRaw('category_type_id, AVG(amount) as average_consumption')
                    ->groupBy('category_type_id');
            }])
            ->with(['type:id,unit_abbreviation'])
            ->get(['id', 'category_id', 'type_id']);

        $result = $result->map(function ($item) {
            return [
                'category' => $item->category->name,
                'average' => round($item->consumptions[0]->average_consumption, 2),
                'unit' => $item->type?->unit_abbreviation,
            ];
        })
        ->sortByDesc('average')
        ->values();

        $total = $result->sum('average');

        return $this->success(
            'Consumo promedio de combustible por categoría',
            $result->map(
                fn ($item) => [
                    'category' => $item['category'],
                    'average' => $item['average'],
                    'unit' => $item['unit'],
                    'percentage' => ($total > 0 ? round($item['average'] / $total * 100, 2) . '%' : '0%'),
                ]
            )
        );
    }
}

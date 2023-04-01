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
            new CategoryTypeResource($type)
        );
    }

    public function show(CategoryType $categoryType)
    {
        return $this->success(
            'Categoria de consumo',
            new CategoryTypeResource($categoryType)
        );
    }

    public function update(UpdateRequest $request, CategoryType $categoryType)
    {
        $categoryType->update($request->all());

        return $this->success(
            'Categoria de consumo actualizada',
            new CategoryTypeResource($categoryType)
        );
    }

    public function destroy(CategoryType $categoryType)
    {
        $categoryType->delete();

        return $this->success(
            'Categoria de consumo eliminada',
        );
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return $this->success(
            'Categorias de consumos',
            CategoryResource::collection(Category::all())
        );
    }

    public function store(StoreRequest $request)
    {
        $category = Category::create($request->all());

        return $this->success(
            'Categoria de consumo creada',
            new CategoryResource($category)
        );
    }

    public function show(Category $category)
    {
        return $this->success(
            'Categoria de consumo',
            new CategoryResource($category)
        );
    }

    public function update(UpdateRequest $request, Category $category)
    {
        $category->update($request->all());

        return $this->success(
            'Categoria de consumo actualizada',
            new CategoryResource($category)
        );
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return $this->success(
            'Categoria de consumo eliminada',
        );
    }
}

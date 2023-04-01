<?php

namespace App\Http\Controllers;

use App\Http\Requests\Place\StoreRequest;
use App\Http\Requests\Place\UpdateRequest;
use App\Http\Resources\PlaceResource;
use App\Models\Place;

class PlaceController extends Controller
{
    public function index()
    {
        return $this->success(
            'Propiedades',
            PlaceResource::collection(Place::all())
        );
    }

    public function store(StoreRequest $request)
    {
        $place = Place::create($request->all());

        return $this->success(
            'Propiedad creada',
            new PlaceResource($place)
        );
    }

    public function show(Place $place)
    {
        return $this->success(
            'Propiedad',
            new PlaceResource($place)
        );
    }

    public function update(UpdateRequest $request, Place $place)
    {
        $place->update($request->all());

        return $this->success(
            'Propiedad actualizada',
            new PlaceResource($place)
        );
    }

    public function destroy(Place $place)
    {
        $place->delete();

        return $this->success(
            'Propiedad eliminada',
        );
    }
}

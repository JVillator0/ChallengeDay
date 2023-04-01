<?php

namespace App\Http\Controllers;

use App\Http\Requests\Trip\StoreRequest;
use App\Http\Requests\Trip\UpdateRequest;
use App\Http\Resources\TripResource;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        return $this->success(
            'Viajes listados correctamente',
            TripResource::collection(Trip::all())
        );
    }

    public function store(StoreRequest $request)
    {
        $trip = Trip::create($request->all());

        return $this->success(
            'Viaje creado correctamente',
            new TripResource($trip)
        );
    }

    public function show(Trip $trip)
    {
        return $this->success(
            'Viaje listado correctamente',
            new TripResource($trip)
        );
    }

    public function update(UpdateRequest $request, Trip $trip)
    {
        $trip->update($request->all());

        return $this->success(
            'Viaje actualizado correctamente',
            new TripResource($trip)
        );
    }

    public function destroy(Trip $trip)
    {
        $trip->delete();

        return $this->success(
            'Viaje eliminado correctamente',
            new TripResource($trip)
        );
    }
}

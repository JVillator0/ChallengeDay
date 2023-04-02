<?php

namespace App\Http\Controllers;

use App\Http\Requests\Trip\StoreRequest;
use App\Http\Requests\Trip\UpdateRequest;
use App\Http\Resources\TripResource;
use App\Models\Deparment;
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
            new TripResource($trip),
            201
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
            null,
            204
        );
    }

    public function monthlyAverageTripsByDeparment()
    {
        $trips = Trip::selectRaw('MONTH(trips.trip_date) as month, deparments.name as deparment, COUNT(trips.id) as trips')
            ->join('deparments', 'deparments.id', '=', 'trips.deparment_id')
            ->groupBy('month', 'deparment')
            ->get();

        $trips = $trips->groupBy('deparment')->values();

        $result = $trips->map(function ($item, $key) {
            return [
                'deparment' => $item[0]->deparment,
                'trips' => $item->sum('trips') / $item->count()
            ];
        });

        return $this->success(
            'Viajes mensuales por departamento',
            $result
        );
    }
}

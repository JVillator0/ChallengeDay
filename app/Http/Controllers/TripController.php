<?php

namespace App\Http\Controllers;

use App\Http\Requests\Trip\StoreRequest;
use App\Http\Requests\Trip\UpdateRequest;
use App\Http\Resources\TripResource;
use App\Models\Department;
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

    public function monthlyAverageTripsByDepartment()
    {
        $trips = Trip::selectRaw('MONTH(trips.trip_date) as month, departments.name as department, COUNT(trips.id) as trips')
            ->join('departments', 'departments.id', '=', 'trips.department_id')
            ->groupBy('month', 'department')
            ->get();

        $trips = $trips->groupBy('department')->values();

        $result = $trips->map(function ($item, $key) {
            return [
                'department' => $item[0]->department,
                'trips' => $item->sum('trips') / $item->count()
            ];
        });

        return $this->success(
            'Viajes mensuales por departamento',
            $result
        );
    }
}

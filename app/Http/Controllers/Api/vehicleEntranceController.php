<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VehicleEntrance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class vehicleEntranceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(VehicleEntrance::all(), 200);
    }

    public function getTodayVehicleEntrances()
    {
        $today = Carbon::today();
        $entrances = VehicleEntrance::whereDate('check_in_time', $today)->with('cluster:name,id')->with('user:name,id')->get(['id', 'plates', 'check_in_time', 'check_out_time', 'user_id','cluster_id']);

        $entrances = $entrances->map(function($entrances) {
            return [
                'id' => $entrances->id,
                'plates' => $entrances->plates,
                'check_in_time' => $entrances->check_in_time,
                'check_out_time' => $entrances->check_out_time,
                'user_name' => $entrances->user->name,
                'cluster_name' => $entrances->cluster->name,
            ];
        });

        
        if($entrances->isEmpty()){
            $dato = ['mensaje' => "No hay entradas hoy"];
            return response()->json($dato, 401);
        } else{
            return response()->json($entrances, 200);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

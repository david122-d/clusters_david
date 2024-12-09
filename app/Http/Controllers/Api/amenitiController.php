<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Cluster;
use Illuminate\Http\Request;

class amenitiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Amenity::all(), 200);
    }

    /** Obtener las amenidades activas */
    public function getAmenitieActive()
    {
        $amenities = Amenity::where('status', 'activa')->with('cluster:name,id')->get(['id', 'name', 'type', 'cluster_id']);

        $amenities = $amenities->map(function($amenities) {
            return [
                'id' => $amenities->id,
                'name' => $amenities->name,
                'type' => $amenities->type,
                'cluster_name' => $amenities->cluster->name,
            ];
        });

        if($amenities->isEmpty()){
            $dato = ['mensaje' => "No hay amenidades activas"];
            return response()->json($dato, 400);
        }else{
            return response()->json($amenities, 200);
        }
    }
    
    /** Obtener las amenidades inactivas */
    public function getAmenitieInactive()
    {
        $amenities = Amenity::where('status', 'inactiva')->with('cluster:name,id')->get(['id', 'name', 'type', 'cluster_id']);

        $amenities = $amenities->map(function($amenities) {
            return [
                'id' => $amenities->id,
                'name' => $amenities->name,
                'type' => $amenities->type,
                'cluster_name' => $amenities->cluster->name,
            ];
        });

        if($amenities->isEmpty()){
            $dato = ['mensaje' => "No hay amenidades inactivas"];
            return response()->json($dato, 400);
        }else{
            return response()->json($amenities, 200);
        }
        
    }

    /** Obtener las amenidades inactivas */
    public function getAmenitieManitenance()
    {
        $amenities = Amenity::where('status', 'En mantenimiento')->with('cluster:name,id')->get(['id', 'name', 'type', 'cluster_id']);

        $amenities = $amenities->map(function($amenities) {
            return [
                'id' => $amenities->id,
                'name' => $amenities->name,
                'type' => $amenities->type,
                'cluster_name' => $amenities->cluster->name,
            ];
        });

        if($amenities->isEmpty()){
            $dato = ['mensaje' => "No hay amenidades en mantenimiento"];
            return response()->json($dato, 400);
        }else{
            return response()->json($amenities, 200);
        }    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
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

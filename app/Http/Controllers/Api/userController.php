<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    /**
     * Obtener ls usuarios que estan fuera de servicio
     */
    public function getUsersOutOfService()
    {
        $users = User::where('action', 'out of service')->with('cluster:name,id')->select('id', 'name', 'turn', 'cluster_id')->get();

        $users = $users->map(function($users) {
            return [
                'id' => $users->id,
                'name' => $users->name,
                'turn' => $users->turn,
                'cluster_name' => $users->cluster->name,
            ];
        });

        if($users->isEmpty()){
            $dato = ['mensaje' => "No hay usuarios fuera de servicio"];
            return response()->json($dato, 401);
        } else{
            return response()->json($users, 200);
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

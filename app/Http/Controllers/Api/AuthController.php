<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PharIo\Manifest\Email;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || Hash::check($request->password, $user->password)){
            return response([
                "error" => "Credenciales Incorrectas",
                "message" => "Usuarip y/o Contraseña incorrecta"
            ], 400);
        }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response([
                "access_token" => $token,
                "token_type" => "Bearer",
            ], 200);
        
    }
}

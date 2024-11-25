<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/principal', function () {
    return view('control.principal');
});

//Luego de hacer la autentificacion con middleware se puede accedes a las siguientes funciones
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    //Funciones para llevar a las vistas de los objetos
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});

Route::get('/stand', function () {
    return view('stand');
})->name('stand');

Route::get('/user', function () {
    return view('user');
})->name('user');

Route::get('/amenitie', function () {
    return view('amenitie');
})->name('amenitie');

Route::get('/house', function () {
    return view('house');
})->name('house');

Route::get('/veicle-entrance', function () {
    return view('veicle_entrance');
})->name('veicle_entrance');



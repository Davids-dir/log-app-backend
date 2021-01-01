<?php

use App\Http\Controllers\LogController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas para Registro, Modificacion y eliminar un usuario
// Endpoint para realizar el Registro de un nuevo empleado
Route::post ('/user/register', [ UserController::class, 'register' ]) -> name ('register');

// Endpoint para realizar el Login en la aplicación
Route::post ('/user/login', [ UserController::class, 'login']) -> name ('login');

// Endpoint para realizar el Logout de la aplicación
Route::post ('/user/logout', [UserController::class, 'logout']) -> name ('logout')->middleware('auth:api'); 

// Endpoint para  realizar una busqueda de un empleado concreto
Route::post('user/search_one', [ UserController::class, 'search_one']) -> name ('search_one');

// Rutas para registro de jornada
// Endopoint para registrar el inicio de la jornada
Route::post('log/start/{id}', [LogController::class, 'start_work'])->name('start_work');
<?php

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

// Rutas
// Endpoint para realizar el Registro de un nuevo empleado
Route::post ('/user/register', [ UserController::class, 'register' ]) -> name ('register');

// Endpoint para realizar el Login en la aplicación
Route::post ('/user/login', [ UserController::class, 'login']) -> name ('login');


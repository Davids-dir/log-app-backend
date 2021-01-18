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

// Rutas para Registro, Modificacion y eliminar un empleado
// Endpoint para realizar el Registro de un nuevo empleado
Route::post ('/user/register', [ UserController::class, 'register' ]) -> name ('register');

// Endpoint para realizar el Login en la aplicación
Route::post ('/user/login', [ UserController::class, 'login']) -> name ('login');

// Endpoint para realizar el Logout de la aplicación
Route::post ('/user/logout', [UserController::class, 'logout']) -> name ('logout')->middleware('auth:api'); 

// Endpoint para  realizar una busqueda de un empleado concreto
Route::post('user/search_one', [ UserController::class, 'search_one']) -> name ('search_one');

// Endpoint para realizar una modificacion de un empleado
Route::put('user/update', [UserController::class, 'update'])->name('update');

// Endpoint para eliminar a un empleado
Route::delete('admin/delete/{id}', [UserController::class, 'delete'])->name('delete');

// Rutas para registro de jornada
// Endopoint para registrar el inicio de la jornada
Route::post('log/start/{id}', [LogController::class, 'start_work'])->name('start_work');

// Endpoint para realizar las modificaciones en el turno de un trabajador
Route::put('log/update.stop/{id}', [LogController::class, 'end_work'])->name('end_work');
Route::put('log/update.startpause/{id}', [LogController::class, 'start_pause'])->name('start_pause');
Route::put('log/update.endpause/{id}', [LogController::class, 'end_pause'])->name('end_pause');

// Endpoint para mostrar todas las jornadas de todos los trabajadores
Route::get('log/showall', [LogController::class, 'show_all'])->name('show_all');
Route::match(['get', 'post'], 'log/showone/{id}', [LogController::class, 'show_one'])->name('show_one');
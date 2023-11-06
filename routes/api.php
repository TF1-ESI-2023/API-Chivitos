<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChivitoController;
use App\Http\Middleware\Autenticacion;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/chivito", [ChivitoController::class, "Mostrar"])->middleware(Autenticacion::class);
Route::post("/chivito", [ChivitoController::class, "Crear"])->middleware(Autenticacion::class);

<?php

use App\Http\Controllers\ContainerController;
use App\Http\Controllers\ProductController;
use App\Models\Territory;
use App\Models\TerritoryQuarter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('products', ProductController::class);
Route::post('products/mass-create', 'App\Http\Controllers\ProductController@massStore');
Route::apiResource('containers', ContainerController::class);


Route::get('territory-quarters', function() {
    return TerritoryQuarter::all();
});
Route::post('territory-quarters', function(Request $request) {
    $obj = new TerritoryQuarter();
    $obj->name = $request->name;
    $obj->code = $request->code;
    $obj->save();
    return response()->json($obj, 201);
});

Route::get('territories', function() {
    return Territory::all();
});

Route::post('territories', function(Request $request){
    $obj = new Territory();
    $obj->name = $request->name;
    $obj->code = $request->code;
    $obj->number = $request->number;
    $obj->quarter = $request->quarter;
    $obj->save();
    return response()->json($obj, 201);
});

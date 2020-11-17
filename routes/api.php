<?php

declare(strict_types=1);

use App\Http\Controllers\HopController;
use App\Http\Controllers\YeastController;
use App\Http\Controllers\FermentableController;
use App\Http\Controllers\ExtraController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('hops', [HopController::class, 'index']);
Route::get('hops/{hop}', [HopController::class, 'show']);
Route::post('hops', [HopController::class, 'store']);
Route::put('hops/{hop}', [HopController::class, 'update']);
Route::delete('hops/{hop}', [HopController::class, 'destroy']);

Route::get('yeasts', [YeastController::class, 'index']);
Route::get('yeasts/{yeast}', [YeastController::class, 'show']);
Route::post('yeasts', [YeastController::class, 'store']);
Route::put('yeasts/{yeast}', [YeastController::class, 'update']);
Route::delete('yeasts/{yeast}', [YeastController::class, 'destroy']);

Route::get('fermentables', [FermentableController::class, 'index']);
Route::get('fermentables/{fermentable}', [FermentableController::class, 'show']);
Route::post('fermentables', [FermentableController::class, 'store']);
Route::put('fermentables/{fermentable}', [FermentableController::class, 'update']);
Route::delete('fermentables/{fermentable}', [FermentableController::class, 'destroy']);

Route::get('extras', [ExtraController::class, 'index']);
Route::get('extras/{extra}', [ExtraController::class, 'show']);
Route::post('extras', [ExtraController::class, 'store']);
Route::put('extras/{extra}', [ExtraController::class, 'update']);
Route::delete('extras/{extra}', [ExtraController::class, 'destroy']);


<?php

declare(strict_types=1);

use App\Http\Controllers\HopController;
use App\Http\Controllers\YeastController;
use App\Http\Controllers\FermentableController;
use App\Http\Controllers\ExtraController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Hop;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('hops', 'HopController@index');
Route::get('hops/{name}', 'HopController@show');
Route::get('hops/user/{userId}', 'HopController@all');
Route::post('hops', 'HopController@store');
Route::delete('hops/{id}', 'HopController@delete');

Route::get('yeasts', 'YeastController@index');
Route::get('yeasts/{name}', 'YeastController@show');
Route::get('yeasts/user/{userId}', 'YeastController@all');
Route::post('yeasts', 'YeastController@store');
Route::delete('yeasts/{id}', 'YeastController@delete');

Route::get('fermentables', 'FermentableController@index');
Route::get('fermentables/{name}', 'FermentableController@show');
Route::get('fermentables/user/{userId}', 'FermentableController@all');
Route::post('fermentables', 'FermentableController@store');
Route::delete('fermentables/{id}', 'FermentableController@delete');

Route::get('extras', 'ExtraController@index');
Route::get('extras/{name}', 'ExtraController@show');
Route::get('extras/user/{userId}', 'ExtraController@all');
Route::post('extras', 'ExtraController@store');
Route::delete('extras/{id}', 'ExtraController@delete');


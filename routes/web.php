<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClaimsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/basicInsight', function () {
        return view('dashboard');
    })->name('dashboard');
});

//Insights
Route::get('/dashboards/claimsInsight', [ClaimsController::class, 'claimsDashboard'])->name('claimsDashboard');
Route::get('/dashboards/providersInsight', [ClaimsController::class, 'providersDashboard'])->name('providersDashboard');

//Users
Route::get('/users/create', [ClaimsController::class, 'createUser'])->name('createUser');
Route::post('/users', [ClaimsController::class, 'storeUser'])->name('storeUser');
Route::get('/users/view', [ClaimsController::class, 'viewUser'])->name('viewUser');

//Claims
Route::get('/claims', [ClaimsController::class, 'claims'])->name('claims');
Route::get('/claims-summary', [ClaimsController::class, 'claimsSummary'])->name('claimsSummary');

//Registers
Route::get('/providers', [ClaimsController::class, 'providers'])->name('providers');
Route::get('/enrollees', [ClaimsController::class, 'enrollees'])->name('enrollees');
Route::get('/clients', [ClaimsController::class, 'clients'])->name('clients');

//tariffs
Route::get('/tariffs', [ClaimsController::class, 'tariffs'])->name('tariffs');
Route::post('/tariffs/{tariff}', 'App\Http\Controllers\ClaimsController@update')->name('tariffs.update');
Route::get('/tariffs/edit/{tariff}', 'App\Http\Controllers\ClaimsController@edit')->name('tariffs.edit');
Route::get('/tariffs/create', 'App\Http\Controllers\ClaimsController@create')->name('tariffs.create');
Route::post('/tariffs', 'App\Http\Controllers\ClaimsController@store')->name('tariffs.store');
Route::delete('/tariffs/{tariff}', 'App\Http\Controllers\ClaimsController@destroy')->name('tariffs.destroy');
Route::get('/tariffs/{tariff}', 'App\Http\Controllers\ClaimsController@show')->name('tariffs.show');


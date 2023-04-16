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
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/claims', [ClaimsController::class, 'claims'])->name('claims');

Route::get('/claims-summary', [ClaimsController::class, 'claimsSummary'])->name('claimsSummary');

Route::get('/providers', [ClaimsController::class, 'providers'])->name('providers');

Route::get('/enrollees', [ClaimsController::class, 'enrollees'])->name('enrollees');

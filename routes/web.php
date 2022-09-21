<?php

use App\Http\Controllers\FareController;
use App\Http\Controllers\OperatorController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [FareController::class, 'index'])->name('welcome');
Route::post('/operators', [OperatorController::class, 'store'])->name('operators.store');
Route::get('/fares/change-status/{id}', [FareController::class, 'changeStatus'])->name('change.status');

Route::resource('fares', FareController::class);

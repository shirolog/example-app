<?php

use App\Http\Controllers\HomeBudgetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', [HomeBudgetController::class, 'index'])
->name('index');


Route::post('/store', [HomeBudgetController::class, 'store'])
->name('store');


Route::get('/edit/{homeBudget}', [HomeBudgetController::class, 'edit'])
->name('homebudget.edit');
Route::put('/edit/{homeBudget}', [HomeBudgetController::class, 'update'])
->name('homebudget.update');



Route::delete('index/{homeBudget}', [HomeBudgetController::class, 'destroy'])
->name('homebudget.destroy');
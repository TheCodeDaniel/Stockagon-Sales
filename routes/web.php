<?php

use App\Http\Controllers\AppController;
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

// Pages routes
Route::get('/', [AppController::class, 'index'])->name('dashboard');

Route::get('/pos', [AppController::class, 'pos'])->name('pos');

Route::get('/records', [AppController::class, 'recordsPage'])->name('records');

Route::get('receipt', [AppController::class, 'receiptPage'])->name('receipt');

// Route::get('/searched', [AppController::class, ''])


// function routes

Route::get('/action-complete', [AppController::class, 'action']);

Route::post('addProducts', [AppController::class, 'addProducts'])->name('add');

Route::get('searchProds', [AppController::class, 'searchProds'])->name('search');

Route::post('/sellProds', [AppController::class, 'sellProds']);

Route::delete('deleteProds/{id}', [AppController::class, 'deleteProds'])->name('prod.del');

// Route::get('/', function () {
//     return view('welcome');
// });

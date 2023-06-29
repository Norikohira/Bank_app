<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [AccountController::class, 'dashboard'])->name('dashboard');

    Route::group(['prefix' => 'account', 'as' => 'account.'], function(){
        Route::get('/', [AccountController::class, 'index'])->name('index');
        Route::get('/create', [AccountController::class, 'create'])->name('create');
        Route::post('/store', [AccountController::class, 'store'])->name('store');
        Route::get('/{id}/show', [AccountController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AccountController::class, 'edit'])->name('edit');
        Route::patch('/{id}/update', [AccountController::class, 'update'])->name('update');
    });
});
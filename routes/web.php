<?php

use App\Http\Controllers\ClientController;
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

Route::view('/','welcome');

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function(){
    Route::view('/dashboard','index')->name('dashboard');

    // clients
    Route::prefix('clients')->name('client.')->group(function(){
        Route::get('/',[ClientController::class,'index'])->name('index');
        Route::get('/create',[ClientController::class,'create'])->name('create');
        Route::post('/',[ClientController::class,'store'])->name('store');
        Route::get('/{client}',[ClientController::class,'edit'])->name('edit');
        Route::patch('/{client}',[ClientController::class,'update'])->name('update');
    });
});

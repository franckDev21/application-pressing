<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeController;
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
        Route::get('/api',[ClientController::class,'indexApi'])->name('indexApi');
        Route::get('/',[ClientController::class,'index'])->name('index');
        Route::get('/create',[ClientController::class,'create'])->name('create');
        Route::post('/',[ClientController::class,'store'])->name('store');
        Route::get('/{client}',[ClientController::class,'edit'])->name('edit');
        Route::patch('/{client}',[ClientController::class,'update'])->name('update');
        Route::delete('/{client}',[ClientController::class,'destroy'])->name('destroy');

        Route::post('/api',[ClientController::class,'storeApi'])->name('storeApi');
    });

    // commandes
    Route::prefix('commandes')->name('commande.')->group(function(){
        Route::get('/',[CommandeController::class,'index'])->name('index');
        Route::get('/api',[CommandeController::class,'indexApi'])->name('indexApi');
        Route::get('/create',[CommandeController::class,'create'])->name('create');
        Route::post('/',[CommandeController::class,'store'])->name('store');
        Route::get('/{commande}',[CommandeController::class,'edit'])->name('edit');
        Route::patch('/{commande}',[CommandeController::class,'update'])->name('update');
        Route::delete('/{commande}',[CommandeController::class,'destroy'])->name('destroy');
        Route::get('/{commande}/vetements',[CommandeController::class,'vetements'])->name('vetements');
        Route::delete('/{commande}/vetement/{vetement}',[CommandeController::class,'vetementDelete'])->name('vetementDelete');
        Route::post('/{commande}/payer',[CommandeController::class,'payer'])->name('payer');
        
        Route::get('/vetements/api',[CommandeController::class,'vetementTypeApi'])->name('vetementTypeApi');
        Route::post('/vetements',[CommandeController::class,'vetementStore'])->name('vetementStore');
        Route::get('/{commande}/api',[CommandeController::class,'showApi'])->name('show');
    });
});

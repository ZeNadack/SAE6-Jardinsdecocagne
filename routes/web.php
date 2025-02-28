<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourneeController;
use App\Http\Controllers\PointDepotController;
use App\Http\Controllers\CalendrierLivraisonController;
use App\Http\Controllers\AbonnementController;
use App\Http\Controllers\CommandeController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('tournees', TourneeController::class);
Route::resource('point-depots', PointDepotController::class);
Route::resource('calendrier-livraisons', CalendrierLivraisonController::class);
Route::resource('abonnements', AbonnementController::class);

// Afficher le formulaire de création de commande à l'URL /commandes
Route::get('/commandes', [CommandeController::class, 'create'])->name('commandes.create');
// Enregistrer une nouvelle commande
Route::post('/commandes', [CommandeController::class, 'store'])->name('commandes.store');
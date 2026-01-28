<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Front\OrderController as FrontOrderController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\FlavorController;
use App\Http\Controllers\Admin\OrderController;

/*
|--------------------------------------------------------------------------
| FRONT-OFFICE (CLIENT - SANS CONNEXION)
|--------------------------------------------------------------------------
*/

// Page d'accueil (affiche les produits)
Route::get('/', [FrontController::class, 'home'])->name('home');

// Page commande d’un produit
Route::get('/commande/{product}', [FrontController::class, 'create'])
    ->name('order.create');

// Envoi de la commande
Route::post('/commande/{product}', [FrontOrderController::class, 'store'])
    ->name('order.store');
// Page tous les produits
Route::get('/produits', [FrontController::class, 'products'])
    ->name('products.index');
/*
|--------------------------------------------------------------------------
| AUTH (Laravel Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| BACK-OFFICE ADMIN (PROTÉGÉ)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Produits
    Route::resource('products', ProductController::class);

    // Arômes
    Route::resource('flavors', FlavorController::class);

    // Commandes (lecture + mise à jour)
    Route::resource('orders', OrderController::class)
        ->only(['index', 'show', 'update']);
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

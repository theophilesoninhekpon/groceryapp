<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\OfferController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    
    // Routes du CRUD Offres
    Route::get('/offers', [OfferController::class, 'index'])->name('offers');
    Route::post('/offers/create', [OfferController::class, 'store'])->name('offers.create');
    Route::delete('/offers/{offer}/delete', [OfferController::class, 'destroy'])->name('offers.delete');
    Route::get('/offers/{offer}/show', [OfferController::class, 'getOffer'])->name('offers.show');
    Route::patch('/offers/{offer}/update', [OfferController::class, 'update'])->name('offers.update');

    // Routes du CRUD Tenant
    Route::get('/tenants', [TenantController::class, 'index'])->name('tenants');
    Route::post('/tenants/create', [TenantController::class, 'store'])->name('tenants.create');
    
    // Routes du CRUD Licenses
    Route::get('/licenses', [LicenseController::class, 'index'])->name('licenses');
    Route::post('/licenses/create', [LicenseController::class, 'store'])->name('licenses.create');

    // Routes du CRUD Tickets
    Route::get('/tickets', function () { return Inertia::render('Dashboard');})->name('tickets');

    // Routes du CRUD SuperAdmin (Users)
    Route::get('/superadmin', [UserController::class, 'index'])->name('superadmin');

    // Routes de la vue Dépannage
    Route::get('/troubleshooting', function () { return Inertia::render('Dashboard');})->name('troubleshooting');

    // Routes de la vue Paramètres
    Route::get('/settings', function () { return Inertia::render('Dashboard');})->name('settings');

});

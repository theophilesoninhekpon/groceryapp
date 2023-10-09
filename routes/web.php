<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\RightsManagementController;

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
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
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

    // Route pour afficher la page de gestion des Tenant
    Route::get('/tenants', [TenantController::class, 'index'])
    ->name('tenants');

    // Route pour enregistrer un client
    Route::post('/tenants/create', [TenantController::class, 'store'])->name('tenants.create');
    
    // Route pour afficher la page de gestion des droits
    Route::get('/rights-managements', [RightsManagementController::class, 'index'])
    ->name('rights-managements');
});

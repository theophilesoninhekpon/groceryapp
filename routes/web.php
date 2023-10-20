<?php

use Inertia\Inertia;
use App\Models\License;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\LicenseController;

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

// Route racine de l'application
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});



// Routes de navigation d'utilisateur invité
Route::middleware('guest')->group(function () {
    Route::get('invitation/{id}/{token}', [UserController::class, 'verifyInvitedUser']);
    Route::post('user/login-store', [UserController::class, 'authenticateInvitedUser'])->name('invitedUser.store');
    Route::get('unauthorized', [UserController::class, 'showUnauthorizedPage'])->name('unauthorized');
});



// Routes de navigation sur l'application en tant qu'utilisateur connecté
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard', [
            'licenses' => count(License::all()),
            'active_licenses' => count(License::all()->where('status', '=', 'ACTIVE')->all()),
            'inactive_licenses' => count(License::all()->where('status', '=', 'INACTIVE')->all())
        ]);
    })->name('dashboard');

    // Routes du CRUD Offres
    Route::get('/offers', [OfferController::class, 'index'])->name('offers');
    Route::post('/offers/create', [OfferController::class, 'store'])->name('offers.create');
    Route::delete('/offers/{offer}/delete', [OfferController::class, 'destroy'])->name('offers.delete');
    Route::patch('/offers/{offer}/update', [OfferController::class, 'update'])->name('offers.update');

    // Routes du CRUD Tenant
    Route::get('/tenants', [TenantController::class, 'index'])->name('tenants');
    Route::post('/tenants/create', [TenantController::class, 'store'])->name('tenants.create');

    // Routes du CRUD Licenses
    Route::get('/licenses', [LicenseController::class, 'index'])->name('licenses');
    Route::post('/licenses/create', [LicenseController::class, 'store'])->name('licenses.create');
    Route::patch('/licenses/{license}/update', [LicenseController::class, 'update'])->name('licenses.update');
    Route::patch('/licenses/{license}/disable', [LicenseController::class, 'disable'])->name('licenses.disable');

    // Routes du CRUD Tickets
    Route::get('/tickets', function () {
        return Inertia::render('Tickets');
    })->name('tickets');

    // Routes du CRUD SuperAdmin (Users)
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users/send-invitation', [UserController::class, 'sendInvitation'])->name('users.invite');
    Route::delete('invitation/{invitation}/delete', [UserController::class, 'deleteInvitation'])->name('invitation.delete');
    Route::patch('users/{user}/update-right', [UserController::class, 'updateRight'])->name('users.updateRight');
    Route::delete('users/{user}/delete', [UserController::class, 'destroy'])->name('users.delete');

    // Routes de la vue Dépannage
    Route::get('/troubleshooting', function () {
        return Inertia::render('Dashboard');
    })->name('troubleshooting');

    // Routes de la vue Paramètres
    Route::get('/settings', function () {
        return Inertia::render('Dashboard');
    })->name('settings');
});

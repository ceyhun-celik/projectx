<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuditsController,
    AuthorizationsController,
    ChangePasswordController,
    DashboardController,
    ManagementController,
    ProfileController,
    RolesController,
    UsersController
};

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

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified', 'can:status'])->group(function(){
    # Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    # Profile
    Route::resource('profile', ProfileController::class)->only(['index', 'store']);

    # Change Password
    Route::resource('change-password', ChangePasswordController::class)->only(['index', 'store']);

    Route::middleware(['can:root'])->prefix('management')->group(function(){
        # Management
        Route::get('/', [ManagementController::class, 'index'])->name('management.index');

        # Roles
        Route::get('roles', [RolesController::class, 'index'])->name('roles.index');

        # Users
        Route::resource('users', UsersController::class);
        Route::prefix('users')->name('users.')->group(function(){
            Route::get('{id}/watch', [UsersController::class, 'watch'])->name('watch');
            Route::get('{id}/audits', [UsersController::class, 'audits'])->name('audits');
        });

        # Authorizations
        Route::resource('authorizations', AuthorizationsController::class);
        Route::prefix('authorizations')->name('authorizations.')->group(function(){
            Route::get('{id}/audits', [AuthorizationsController::class, 'audits'])->name('audits');
        });

        # Audits
        Route::resource('audits', AuditsController::class)->only(['index', 'show']);
    });

});

require __DIR__.'/auth.php';

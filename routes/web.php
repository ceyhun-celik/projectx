<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuditsController,
    AuthorizationsController,
    ChangePasswordController,
    DashboardController,
    ManagementController,
    ProfileController,
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

Route::middleware(['auth', 'verified'])->group(function(){
    # Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    # Profile
    Route::resource('profile', ProfileController::class)->only(['index', 'store']);

    # Change Password
    Route::resource('change-password', ChangePasswordController::class)->only(['index', 'store']);

    Route::prefix('management')->group(function(){
        Route::get('/', [ManagementController::class, 'index'])->name('management.index');

        # Users
        Route::resource('users', UsersController::class);
        Route::get('users/{id}/audits', [UsersController::class, 'audits'])->name('users.audits');

        Route::resources([
            'authorizations' => AuthorizationsController::class,
            'audits' => AuditsController::class
        ]);
    });

});

require __DIR__.'/auth.php';

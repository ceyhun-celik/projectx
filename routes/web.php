<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuditsController,
    AuthorizationsController,
    DashboardController,
    ManagementController,
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
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('management')->group(function(){
        Route::get('/', [ManagementController::class, 'index'])->name('management.index');

        # Users
        Route::resource('users', UsersController::class);
        Route::get('users/{id}/audits', [UsersController::class, 'audits'])->name('users.audits');

        Route::resources([
            // 'users' => UsersController::class,
            'authorizations' => AuthorizationsController::class,
            'audits' => AuditsController::class
        ]);
    });

});

require __DIR__.'/auth.php';

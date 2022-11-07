<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuditsController,
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

        Route::resources([
            'users' => UsersController::class,
            'audits' => AuditsController::class
        ]);
    });

});

require __DIR__.'/auth.php';

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

Route::middleware(['auth', 'verified', 'can:status', 'locale'])->group(function(){
    # Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    # Profile
    Route::resource('profile', ProfileController::class)->only(['index', 'store']);

    # Change Password
    Route::resource('change-password', ChangePasswordController::class)->only(['index', 'store']);

    # Management
    Route::prefix('management')->group(function(){
        # Management > Root Access
        Route::middleware('can:root_access')->group(function(){
            # Users Audits
            Route::controller(UsersController::class)->prefix('users')->name('users.')->group(function(){
                Route::get('trash', 'trash')->name('trash');
                Route::get('{id}/deleted', 'deleted')->name('deleted');
                Route::put('{id}/restore', 'restore')->name('restore');
                Route::get('{id}/watch', 'watch')->name('watch');
                Route::get('{id}/audits', 'audits')->name('audits');
            });
            
            # Authorizations Audits
            Route::controller(AuthorizationsController::class)->prefix('authorizations')->name('authorizations.')->group(function(){
                Route::get('trash', 'trash')->name('trash');
                Route::get('{id}/deleted', 'deleted')->name('deleted');
                Route::get('{id}/audits', 'audits')->name('audits');
            });
    
            # Audits
            Route::resource('audits', AuditsController::class)->only(['index', 'show']);
        });
        
        # Management > Admin Access
        Route::middleware('can:admin_access')->group(function(){
            # Management Index
            Route::get('/', [ManagementController::class, 'index'])->name('management.index');
    
            # Roles
            Route::get('roles', [RolesController::class, 'index'])->name('roles.index');

            # Users
            Route::resource('users', UsersController::class);

            # Authorizations
            Route::resource('authorizations', AuthorizationsController::class);
        });
    });
});

require __DIR__.'/auth.php';

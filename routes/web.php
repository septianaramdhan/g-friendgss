<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Super\LaporanController;

use App\Http\Controllers\Super\DashboardController as SuperDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Operator\DashboardController as OperatorDashboard;

/*
|--------------------------------------------------------------------------
| DEFAULT
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| AUTH (ONLY GUEST CAN ACCESS)
|--------------------------------------------------------------------------
*/

Route::middleware(['guest'])->group(function () {

    Route::get('/login', [AuthController::class, 'loginForm'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');
});


/*
|--------------------------------------------------------------------------
| PROTECTED AREA (HARUS LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    })->name('logout');


    /*
    |--------------------------------------------------------------------------
    | SUPER ADMIN
    |--------------------------------------------------------------------------
    */

    Route::middleware(['auth', 'role:superadmin'])
    ->name('super.')
    ->group(function () {

        Route::get('/dashboard', [SuperDashboard::class, 'index'])
            ->name('dashboard');
    
        Route::get('/users', [UserController::class, 'index'])
            ->name('index');

        Route::get('/users/create', [UserController::class, 'create'])
            ->name('create');

        Route::post('/users/store', [UserController::class, 'store'])
            ->name('store');

        Route::get('/users/edit/{id}', [UserController::class, 'edit'])
            ->name('edit');

        // 🔥 INI YANG DIGANTI POST → PUT
        Route::put('/users/update/{id}', [UserController::class, 'update'])
            ->name('update');

        Route::delete('/users/{id}', [UserController::class, 'destroy'])
            ->name('destroy');

             // 🔥 LAPORAN
        Route::get('/laporan/transaksi', [LaporanController::class, 'transaksi'])
            ->name('laporan.transaksi');

        Route::get('/laporan/pendapatan', [LaporanController::class, 'pendapatan'])
            ->name('laporan.pendapatan');

        Route::get('/laporan/stok', [LaporanController::class, 'stok'])
            ->name('laporan.stok');
    });


    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:admin'])->group(function () {

        Route::get('/admin/dashboard', [AdminDashboard::class, 'index'])
            ->name('admin.dashboard');
    });


    /*
    |--------------------------------------------------------------------------
    | KASIR
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:operator'])->group(function () {

        Route::get('/operator/dashboard', [OperatorDashboard::class, 'index'])
            ->name('operator.dashboard');
    });
});
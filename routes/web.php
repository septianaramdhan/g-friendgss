<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Super\LaporanController;
use App\Http\Controllers\Super\BarangController;
use App\Http\Controllers\Super\DiskonController;

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

    
Route::middleware(['auth','role:superadmin'])
->prefix('super')
->name('super.')
->group(function () {

    // LIST BARANG
    Route::get('/barang', [BarangController::class,'index'])
        ->name('barang.index');

    // HALAMAN CREATE
    Route::get('/barang/create', [BarangController::class,'create'])
        ->name('barang.create');

    // STORE
    Route::post('/barang/store', [BarangController::class,'store'])
        ->name('barang.store');

    // EDIT
    Route::get('/barang/{id}/edit', [BarangController::class,'edit'])
        ->name('barang.edit');

    // UPDATE
    Route::put('/barang/{id}', [BarangController::class,'update'])
        ->name('barang.update');

    // DELETE
    Route::delete('/barang/{id}', [BarangController::class,'destroy'])
        ->name('barang.destroy');

});

Route::prefix('super')->name('super.')->middleware(['auth','role:superadmin'])->group(function(){

    Route::get('/diskon', [DiskonController::class,'index'])->name('diskon.index');

    Route::get('/diskon/create', [DiskonController::class,'create'])->name('diskon.create');

    Route::post('/diskon/store', [DiskonController::class,'store'])->name('diskon.store');

    Route::get('/diskon/{id}/edit', [DiskonController::class,'edit'])->name('diskon.edit');

    Route::put('/diskon/{id}', [DiskonController::class,'update'])->name('diskon.update');

    Route::delete('/diskon/{id}', [DiskonController::class,'destroy'])->name('diskon.destroy');

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

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;

// LOGIN: hanya untuk pengunjung yang belum login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);
});

// BERANDA: bisa diakses semua orang
Route::get('/', [MenuController::class, 'beranda'])
    ->name('beranda');

// ROUTE KHUSUS PENGGUNA YANG SUDAH LOGIN
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return redirect()->route('beranda');
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // ADMIN DAN KASIR
    Route::middleware('role:admin,kasir')->group(function () {

        // READ
        Route::get('/menu', [MenuController::class, 'index'])
            ->name('menu.index');

        // CREATE
        Route::get('/menu/tambah', [MenuController::class, 'create'])
            ->name('menu.create');

        Route::post('/menu/simpan', [MenuController::class, 'store'])
            ->name('menu.store');

        // UPDATE
        Route::get('/menu/{id}/edit', [MenuController::class, 'edit'])
            ->whereNumber('id')
            ->name('menu.edit');

        Route::put('/menu/{id}', [MenuController::class, 'update'])
            ->whereNumber('id')
            ->name('menu.update');
    });

    // KHUSUS ADMIN: DELETE
    Route::middleware('role:admin')->group(function () {
        Route::delete('/menu/{id}', [MenuController::class, 'destroy'])
            ->whereNumber('id')
            ->name('menu.destroy');
    });
});

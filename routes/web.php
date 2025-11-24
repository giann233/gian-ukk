<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

require __DIR__.'/auth.php';

// Login route for members (store owners)
Route::get('/login/member', function () {
    return view('auth.login-member');
})->name('login.member');

// Login route for students (siswa)
Route::get('/login/siswa', function () {
    return view('auth.login-siswa');
})->name('login.siswa');

// Admin login routes
Route::get('/admin/login', [App\Http\Controllers\Auth\AdminAuthenticatedSessionController::class, 'create'])
    ->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\Auth\AdminAuthenticatedSessionController::class, 'store']);
Route::post('/admin/logout', [App\Http\Controllers\Auth\AdminAuthenticatedSessionController::class, 'destroy'])
    ->name('admin.logout');

// Admin dashboard route
Route::get('/admin/dashboard', [App\Http\Controllers\DashboardController::class, 'admin'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');

// Admin routes for managing products
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('produks', App\Http\Controllers\ProdukController::class);
    Route::resource('tokos', App\Http\Controllers\TokoController::class);
    Route::resource('kategoris', App\Http\Controllers\KategoriController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
});

Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Public routes for browsing
Route::get('/tokos', [App\Http\Controllers\TokoController::class, 'index'])->name('tokos.index');
Route::get('/tokos/{id}', [App\Http\Controllers\TokoController::class, 'show'])->name('tokos.show');
Route::get('/produks', [App\Http\Controllers\ProdukController::class, 'index'])->name('produks.index');
Route::get('/produks/{id}', [App\Http\Controllers\ProdukController::class, 'show'])->name('produks.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // Member-only management routes for products and stores
    Route::middleware('member')->group(function () {
        Route::get('my-toko', [App\Http\Controllers\TokoController::class, 'myToko'])->name('tokos.my');
        Route::resource('tokos', App\Http\Controllers\TokoController::class)->except(['index', 'show']);
        Route::resource('produks', App\Http\Controllers\ProdukController::class)->except(['index', 'show']);
    });

    // Admin-only management routes for categories and users
    Route::middleware('admin')->group(function () {
        Route::resource('kategoris', App\Http\Controllers\KategoriController::class);
        Route::resource('users', App\Http\Controllers\UserController::class);
    });

    // Cart and checkout routes
    Route::resource('keranjang', App\Http\Controllers\KeranjangController::class)->except(['create', 'show', 'edit']);
    Route::get('/keranjang/count', [App\Http\Controllers\KeranjangController::class, 'count'])->name('keranjang.count');
    Route::post('/keranjang/clear', [App\Http\Controllers\KeranjangController::class, 'clear'])->name('keranjang.clear');

    Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/summary', [App\Http\Controllers\CheckoutController::class, 'summary'])->name('checkout.summary');

    // Toko request routes with member middleware
    Route::middleware('member')->group(function () {
        Route::get('toko_requests/create', [App\Http\Controllers\TokoRequestController::class, 'create'])->name('toko_requests.create');
        Route::post('toko_requests', [App\Http\Controllers\TokoRequestController::class, 'store'])->name('toko_requests.store');
    });

    Route::resource('toko_requests', App\Http\Controllers\TokoRequestController::class)->except(['create', 'store']);
    Route::post('toko_requests/{id}/approve', [App\Http\Controllers\TokoRequestController::class, 'approve'])->name('toko_requests.approve');
    Route::post('toko_requests/{id}/reject', [App\Http\Controllers\TokoRequestController::class, 'reject'])->name('toko_requests.reject');
});

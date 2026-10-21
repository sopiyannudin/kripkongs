
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*

| RUTE PUBLIK (Customer / Guest)

*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/katalog', [HomeController::class, 'katalog'])->name('katalog');
Route::get('/pesan', [HomeController::class, 'pesan'])->name('pesan');
Route::post('/order', [HomeController::class, 'storeOrder'])->name('order.store');
Route::get('/health', [HomeController::class, 'health'])->name('health');

/*

| RUTE AUTENTIKASI ADMIN

*/

Route::get('/login', [HomeController::class, 'showLoginForm'])->name('login');
Route::post('/login', [HomeController::class, 'login']);
Route::post('/logout', [HomeController::class, 'logout'])->name('logout');

/*

| RUTE KHUSUS ADMIN

*/

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])
        ->name('admin.dashboard');

    Route::post('/admin/produk/store', [HomeController::class, 'storeProduk'])
        ->name('produk.store');

    Route::post('/admin/produk/update/{id}', [HomeController::class, 'updateProduk'])
        ->name('produk.update');

    Route::post('/katalog/upload-gambar/{id}', [HomeController::class, 'uploadGambar'])
        ->name('product.uploadGambar');

    Route::delete('/admin/produk/delete/{id}', [HomeController::class, 'destroyProduk'])
        ->name('produk.destroy');

    // Pesanan & Status
    Route::post('/admin/pesanan/status/{id}', [HomeController::class, 'updateStatusPesanan'])
        ->name('pesanan.updateStatus');

    Route::delete('/admin/pesanan/delete/{id}', [HomeController::class, 'destroyPesanan'])
        ->name('pesanan.destroy');

    Route::get('/health', function () {
        return response('OK', 200)->header('Content-Type', 'text/plain');
    });
});

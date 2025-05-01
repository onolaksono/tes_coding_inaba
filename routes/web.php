<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return redirect('/transaksi');
});
Route::resource('/produk', ProdukController::class);
Route::resource('/transaksi', TransaksiController::class);

// tambah produk ke keranjang
Route::post('/add_to_cart/{id}', [TransaksiController::class, 'add_cart'])->name('add_cart');
// update stok di keranjang
Route::post('/keranjang/update/{id}', [TransaksiController::class, 'updateQty'])->name('keranjang.update');
// hapus semua produk di keranjang
Route::delete('/keranjang/kosongkan', [TransaksiController::class, 'hapus_Semua'])->name('keranjang.kosongkan');
// hapus berdarsarkan id produk pada keranjang
Route::delete('/keranjang/{id}', [TransaksiController::class, 'hapusProduk'])->name('keranjang.destroy');

Route::post('/transaksi/simpan', [TransaksiController::class, 'simpanTransaksi'])->name('transaksi.simpan');

Route::get('/history', [TransaksiController::class, 'history'])->name('history');
Route::delete('/history/{id}', [TransaksiController::class, 'hapus'])->name('transaksi.hapus');

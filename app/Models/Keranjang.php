<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keranjang extends Model
{
    Use HasFactory;
    protected $table = 'keranjang';
    protected $fillable = ['id_produk', 'produk', 'quantity', 'harga', 'subtotal'];

    // Dalam model Keranjang, pastikan ada relasi ke produk yang memiliki stok
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}

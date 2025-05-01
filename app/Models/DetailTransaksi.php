<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailTransaksi extends Model
{
    Use HasFactory;
    protected $table = 'detail_transaksi';
    protected $fillable = ['id_transaksi', 'id_produk', 'quantity'];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk' , 'id');
    }

    public function ambilSubtotal()
    {
        // Menghitung subtotal: harga produk * quantity
        return $this->produk->harga * $this->quantity;
    }
}

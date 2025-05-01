<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    Use HasFactory;
    protected $table = 'produk';
    protected $fillable = ['produk', 'stok', 'harga'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['nama', 'kategori', 'deskripsi', 'harga', 'stok', 'gambar'];

    public function detailPesanan() { return $this->hasMany(DetailPesanan::class); }
    public function keranjang()     { return $this->hasMany(Keranjang::class); }

    // Accessors for backward compatibility with existing blade files
    public function getNameAttribute()        { return $this->nama; }
    public function getPriceAttribute()       { return $this->harga; }
    public function getStockAttribute()       { return $this->stok; }
    public function getImageAttribute()       { 
        if (str_starts_with($this->gambar, 'assets/')) {
            return $this->gambar;
        }
        return 'storage/' . $this->gambar;
    }
    public function getCategoryAttribute()    { return $this->kategori; }
    public function getDescriptionAttribute() { return $this->deskripsi; }
}

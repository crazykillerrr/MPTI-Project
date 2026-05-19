<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $fillable = ['user_id', 'produk_id', 'qty'];

    public function user()    { return $this->belongsTo(User::class); }
    public function produk()  { return $this->belongsTo(Produk::class); }

    // Backward compatibility accessors for existing blade files
    public function product() { return $this->produk(); }
    public function getQuantityAttribute() { return $this->qty; }
}

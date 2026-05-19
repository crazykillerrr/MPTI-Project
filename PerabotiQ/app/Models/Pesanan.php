<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = ['user_id', 'kurir_id', 'status', 'total', 'metode_pembayaran'];

    public function user()          { return $this->belongsTo(User::class); }
    public function kurir()         { return $this->belongsTo(User::class, 'kurir_id'); }
    public function detailPesanan() { return $this->hasMany(DetailPesanan::class); }
    public function transaksi()     { return $this->hasOne(Transaksi::class); }
}

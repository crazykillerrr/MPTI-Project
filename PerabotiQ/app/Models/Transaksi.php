<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = ['pesanan_id', 'user_id', 'total', 'status', 'metode_pembayaran'];

    public function pesanan() { return $this->belongsTo(Pesanan::class); }
    public function user()    { return $this->belongsTo(User::class); }
}

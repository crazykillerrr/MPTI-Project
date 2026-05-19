<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendala extends Model
{
    protected $fillable = ['pesanan_id', 'kurir_id', 'jenis', 'deskripsi'];

    public function pesanan() { return $this->belongsTo(Pesanan::class); }
    public function kurir()   { return $this->belongsTo(User::class, 'kurir_id'); }
}

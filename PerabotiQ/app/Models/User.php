<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'address', 'post_code', 'phone'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime', 'password' => 'hashed'];

    public function isAdmin()    { return $this->role === 'admin'; }
    public function isKurir()    { return $this->role === 'kurir'; }
    public function isCustomer() { return $this->role === 'customer'; }

    public function pesanan()   { return $this->hasMany(Pesanan::class); }
    public function keranjang() { return $this->hasMany(Keranjang::class); }
    public function transaksi() { return $this->hasMany(Transaksi::class); }
}

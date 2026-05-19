<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('produks')) {
            Schema::create('produks', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->string('kategori');
                $table->text('deskripsi')->nullable();
                $table->bigInteger('harga');
                $table->integer('stok')->default(0);
                $table->string('gambar')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('pesanans')) {
            Schema::create('pesanans', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('kurir_id')->nullable()->constrained('users')->nullOnDelete();
                $table->string('status')->default('menunggu_pembayaran');
                $table->bigInteger('total');
                $table->string('metode_pembayaran')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('detail_pesanans')) {
            Schema::create('detail_pesanans', function (Blueprint $table) {
                $table->id();
                $table->foreignId('pesanan_id')->constrained()->onDelete('cascade');
                $table->foreignId('produk_id')->constrained()->onDelete('cascade');
                $table->integer('qty');
                $table->bigInteger('harga');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('transaksis')) {
            Schema::create('transaksis', function (Blueprint $table) {
                $table->id();
                $table->foreignId('pesanan_id')->constrained()->onDelete('cascade');
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->bigInteger('total');
                $table->string('status')->default('pending');
                $table->string('metode_pembayaran')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('kendalas')) {
            Schema::create('kendalas', function (Blueprint $table) {
                $table->id();
                $table->foreignId('pesanan_id')->constrained()->onDelete('cascade');
                $table->foreignId('kurir_id')->constrained('users')->onDelete('cascade');
                $table->string('jenis');
                $table->text('deskripsi');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('keranjangs')) {
            Schema::create('keranjangs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('produk_id')->constrained()->onDelete('cascade');
                $table->integer('qty')->default(1);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('keranjangs');
        Schema::dropIfExists('kendalas');
        Schema::dropIfExists('transaksis');
        Schema::dropIfExists('detail_pesanans');
        Schema::dropIfExists('pesanans');
        Schema::dropIfExists('produks');
    }
};

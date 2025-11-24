<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->foreignId('id_kategori')->constrained('kategori')->onDelete('cascade');
            $table->decimal('harga', 10, 2);
            $table->integer('stok');
            $table->text('deskripsi')->nullable();
            $table->date('tanggal_upload');
            $table->foreignId('id_toko')->constrained('toko')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};

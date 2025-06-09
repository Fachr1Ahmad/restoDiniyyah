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
        Schema::create('mejas', function (Blueprint $table) {
            $table->id();
            $table->string('kodeMeja')->unique();
            $table->timestamps();
        });

        Schema::create('metode_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('metodePembayaran');
            $table->timestamps();
        });

        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->float('total_harga')->default(0);
            $table->timestamps();
        });

        Schema::create('kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('namaKategori');
            $table->timestamps();
        });

        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('namaMenu');
            $table->string('status');
            $table->decimal('harga', 10, 2);
            $table->integer('stok');
            $table->foreignId('kategori_id')->constrained()->onDelete('cascade');
            $table->string('foto');
            $table->timestamps();
        });

        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained()->onDelete('cascade');
            $table->foreignId('menu_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->timestamps();
        });

        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->uuid('order_id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('meja_id')->constrained()->onDelete('cascade');
            $table->decimal('total_harga', 10, 2);
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('pesanan_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained()->onDelete('cascade');
            $table->foreignId('menu_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->timestamps();
        });

        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained()->onDelete('cascade');
            $table->foreignId('metode_pembayaran_id')->constrained()->onDelete('cascade');
            $table->string('statusPembayaran');
            $table->string('buktiPembayaran');
            $table->timestamps();
        });

        // Schema::create('pesanan_cart_items', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('pesanan_id')->constrained()->onDelete('cascade');
        //     $table->foreignId('cart_item_id')->constrained()->onDelete('cascade');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('pesanan_cart_items');
        Schema::dropIfExists('pembayarans');
        Schema::dropIfExists('pesanan_items');
        Schema::dropIfExists('pesanans');
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('menus');
        Schema::dropIfExists('kategoris');
        Schema::dropIfExists('carts');
        Schema::dropIfExists('metode_pembayarans');
        Schema::dropIfExists('mejas');
    }
};

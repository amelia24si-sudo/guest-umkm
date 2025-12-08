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
        Schema::create('ulasan_produk', function (Blueprint $table) {
            $table->id('ulasan_id');
            $table->foreignId('produk_id')->constrained('produk', 'produk_id')->onDelete('cascade');
            $table->foreignId('warga_id')->constrained('warga', 'warga_id')->onDelete('cascade');
            $table->integer('rating')->unsigned()->checkBetween(1, 5);
            $table->text('komentar')->nullable();
            $table->timestamps();

            // Unique constraint untuk mencegah duplikasi ulasan dari warga yang sama
            $table->unique(['produk_id', 'warga_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasan_produk');
    }
};

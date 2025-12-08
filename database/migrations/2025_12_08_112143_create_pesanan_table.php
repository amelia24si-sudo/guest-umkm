<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_pesanan_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('pesanan_id');
            $table->string('nomor_pesanan')->unique();
            $table->foreignId('warga_id')->constrained('warga', 'warga_id')->onDelete('cascade');
            $table->decimal('total', 15, 2);
            $table->enum('status', ['pending', 'diproses', 'dikirim', 'selesai', 'dibatalkan'])->default('pending');
            $table->text('alamat_kirim');
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->enum('metode_bayar', ['transfer', 'cod', 'tunai'])->default('transfer');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
};

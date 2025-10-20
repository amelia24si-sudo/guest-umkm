<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('umkm', function (Blueprint $table) {
            $table->id('umkm_id');
            $table->string('nama_usaha');
            $table->foreignId('pemilik_warga_id')->constrained('warga', 'warga_id')->onDelete('cascade');
            $table->text('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('kategori');
            $table->string('kontak');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umkm');
    }
};

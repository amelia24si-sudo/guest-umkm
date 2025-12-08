// database/migrations/[timestamp]_create_detail_pesanan_table.php

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
        Schema::create('detail_pesanan', function (Blueprint $table) {
            $table->id('detail_id');
            $table->foreignId('pesanan_id')
                  ->constrained('pesanan', 'pesanan_id')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('produk_id')
                  ->constrained('produk', 'produk_id')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
            $table->integer('qty')->default(1);
            $table->decimal('harga_satuan', 15, 2);
            $table->decimal('subtotal', 15, 2);
            $table->timestamps();

            // Composite key untuk mencegah duplikasi produk dalam pesanan yang sama
            $table->unique(['pesanan_id', 'produk_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pesanan');
    }
};

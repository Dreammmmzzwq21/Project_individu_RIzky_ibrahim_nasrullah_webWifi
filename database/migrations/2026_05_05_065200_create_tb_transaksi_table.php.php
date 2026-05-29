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
    Schema::create('tb_transaksi', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_pelanggan')->constrained('tb_user')->onDelete('cascade');
        $table->date('tanggal');
        $table->integer('total_harga');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_transaksi');
    }
};

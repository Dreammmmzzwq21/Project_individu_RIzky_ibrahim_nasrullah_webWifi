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
    Schema::table('tb_transaksi', function (Blueprint $table) {
        $table->string('pengiriman')->nullable()->after('total_harga');
        $table->string('pembayaran')->nullable()->after('pengiriman');
    });
}

public function down(): void
{
    Schema::table('tb_transaksi', function (Blueprint $table) {
        $table->dropColumn(['pengiriman', 'pembayaran']);
    });
}
};

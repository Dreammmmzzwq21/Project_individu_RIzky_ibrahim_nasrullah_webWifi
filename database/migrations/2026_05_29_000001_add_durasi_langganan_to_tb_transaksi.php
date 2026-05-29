<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tb_transaksi', function (Blueprint $table) {
            $table->unsignedSmallInteger('durasi_langganan')->default(1)->after('pembayaran');
        });
    }

    public function down(): void
    {
        Schema::table('tb_transaksi', function (Blueprint $table) {
            $table->dropColumn('durasi_langganan');
        });
    }
};

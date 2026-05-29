<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tb_user', function (Blueprint $table) {
            // Menambahkan kolom jenis_kelamin dan bio setelah kolom hp
            $table->string('jenis_kelamin', 1)->nullable()->after('hp'); 
            $table->text('bio')->nullable()->after('jenis_kelamin');
        });
    }

    public function down(): void
    {
        Schema::table('tb_user', function (Blueprint $table) {
            $table->dropColumn(['jenis_kelamin', 'bio']);
        });
    }
};
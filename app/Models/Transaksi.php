<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'tb_transaksi';
    protected $fillable = ['id_pelanggan', 'tanggal', 'total_harga', 'pengiriman', 'pembayaran', 'durasi_langganan'];
    

    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'id_pelanggan');
    }

    public function details()
    {
        return $this->hasMany(Detail::class, 'id_transaksi');
    }
}

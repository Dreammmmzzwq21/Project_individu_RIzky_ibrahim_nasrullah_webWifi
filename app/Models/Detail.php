<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = 'tb_detail';
    protected $fillable = ['id_transaksi', 'id_produk', 'jumlah'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
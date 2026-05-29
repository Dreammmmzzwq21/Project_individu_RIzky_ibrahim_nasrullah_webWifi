<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'tb_user';

    protected $fillable = [
        'nama', 
        'email', 
        'username', 
        'password', 
        'hp', 
        'alamat', 
        'role',
        'jenis_kelamin', // <-- Tambahkan ini
        'bio' 
              // <-- Tambahkan ini
    ];

    protected $hidden = ['password'];

    protected function casts(): array
    {
        return ['password' => 'hashed'];
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_pelanggan');
    }
}
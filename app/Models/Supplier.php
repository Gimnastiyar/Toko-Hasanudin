<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'nama_supplier',
        'nama_perusahaan',
        'no_telp',
        'email',
        'alamat',
        'kota',
        'kode_pos',
        'saldo_hutang',
        'limit_hutang',
        'jatuh_tempo',
        'status'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

}

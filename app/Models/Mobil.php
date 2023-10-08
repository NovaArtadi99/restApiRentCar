<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $table = 'mobils';
    protected $primaryKey = 'plat_mobil';
    // protected $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'plat_mobil',
        'nama_mobil',
        'warna',
        'tipe',
        'tahun',
        'tgl_pajak',
        'nama_pemilik',
        'cc',
        'harga_sewa',
        'status',
        'gambar_mobil',
        'tgl_catat'
    ];

    protected $casts = [
        'tgl_pajak' => 'date',
        'tgl_catat' => 'date',
        'status' => 'boolean'
    ];

    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'plat_mobil', 'plat_mobil');
    }

    // public function pengeluaran()
    // {
    //     return $this->hasMany(Pengeluaran::class, 'plat_motor', 'plat_motor');
    // }
}

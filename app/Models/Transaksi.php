<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Penyewa;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';
    protected $primaryKey = 'kode_transaksi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_transaksi',
        'plat_mobil',
        'no_paspor',
        'id_pegawai',
        'tgl_mulai',
        'tgl_selesai',
        'total',
        'km_awal',
        'km_akhir',
        'catatan',
        'status_transaksi'
    ];

    public function mobil(): BelongsToMany
    {
        return $this->belongsTo(Mobil::class, 'plat_mobil', 'plat_mobil');
    }

    public function penyewa(): BelongsToMany
    {
        return $this->belongsTo(Penyewa::class, 'no_paspor', 'no_paspor');
    }

    public function pegawai(): BelongsToMany
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id');
    }
    // public function user(): BelongsToMany
    // {
    //     return $this->belongsTo(User::class, 'id_pegawai', 'id');
    // }
}

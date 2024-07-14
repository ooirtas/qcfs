<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    use HasFactory;

    protected $primaryKey = 'kode_produksi';
    protected $fillable = [
        'kode_produksi',
        'nama_produksi',
        'id_barang',
        'jumlah_produksi',
        'barang_diproses',
        'jumlah_proses',
        'status',
    ];
    
    public function proses_produksi(){
        return $this->hasMany(ProsesProduksi::class);
    }

    public function barang(){
        return $this->belongsTo(Barang::class);
    }
}

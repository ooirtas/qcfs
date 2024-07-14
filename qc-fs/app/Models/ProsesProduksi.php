<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsesProduksi extends Model
{
    use HasFactory;

    protected $primaryKey = 'kode_proses';
    protected $fillable = [
        'kode_proses',
        'nama_proses',
        'kode_produksi',
        'proses_ke',
        'tanggal_proses',
        'jumlah_barang',
        'status',
    ];
    
    public function quality_control(){
        return $this->hasMany(QualityControl::class);
    }

    public function produksi(){
        return $this->belongsTo(Produksi::class);
    }
}

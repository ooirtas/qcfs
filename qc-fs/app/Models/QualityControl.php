<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityControl extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_qc';
    protected $fillable = [
        'id_qc',
        'kode_proses',
        'tanggal_qc',
        'diperiksa',
        'layak',
        'reject',
        'repair',
        'deskripsi_repair',
    ];
    

    public function prosesProduksi()
    {
        return $this->belongsTo(ProsesProduksi::class, 'kode_proses', 'kode_proses');
    }
    
}

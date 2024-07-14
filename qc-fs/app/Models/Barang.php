<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_barang';
    protected $fillable = [
        'id_barang',
        'nama_barang',
        'stock',
        'status',
    ];

    public function produksi(){
        return $this->hasMany(Produksi::class);
    }

}

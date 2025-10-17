<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_stok';
    protected $fillable = ['id_barang', 'id_cabang', 'jumlah_masuk', 'jumlah_keluar', 'tanggal'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang');
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'id_gudang', 'id_gudang');
    }

}

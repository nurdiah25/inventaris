<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    protected $table = 'cabangs';
    protected $primaryKey = 'id_cabang';
    protected $fillable = ['nama_cabang', 'alamat'];

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'id_cabang', 'id_cabang');
    }
}

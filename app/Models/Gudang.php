<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_gudang';
    protected $fillable = ['nama_gudang', 'lokasi'];

    public function pengirimans()
    {
        return $this->hasMany(Pengiriman::class, 'id_gudang');
    }

}

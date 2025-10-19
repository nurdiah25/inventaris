<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    protected $table = 'cabangs';
    protected $primaryKey = 'id_cabang';
    protected $fillable = ['nama_cabang', 'alamat', 'slug'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cabang) {
            if (empty($cabang->slug)) {
                $cabang->slug = Str::slug($cabang->nama_cabang);
            }
        });
    }
    
    public function barangs()
    {
        return $this->hasMany(Barang::class, 'id_cabang', 'id_cabang');
    }

    public function stoks()
    {
        return $this->hasMany(Stok::class, 'id_cabang', 'id_cabang');
    }

    public function pengirimans()
    {
        return $this->hasMany(Pengiriman::class, 'id_cabang', 'id_cabang');
    }
}

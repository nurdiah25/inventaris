<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Kolom yang bisa diisi mass assignment.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',      // ← tambahkan kolom role
        'cabang',    // ← tambahkan kolom cabang
    ];

    /**
     * Kolom yang disembunyikan saat serialisasi.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Tipe casting atribut.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Helper: cek apakah user ini superadmin.
     */
    public function isSuperadmin(): bool
    {
        return $this->role === 'superadmin';
    }

    /**
     * Helper: cek apakah user ini admin cabang.
     */
    public function isAdminCabang(): bool
    {
        return $this->role === 'admin_cabang';
    }
}

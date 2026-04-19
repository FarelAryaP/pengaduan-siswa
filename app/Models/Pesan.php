<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;

    protected $table = 'pesan';

    protected $fillable = [
        'pengaduan_id',
        'pengirim_id',
        'isi',
        'role_pengirim',
        'dibaca',
    ];

    protected $casts = [
        'dibaca' => 'boolean',
    ];

    // Relasi ke Pengaduan
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id');
    }

    // Relasi ke User (pengirim)
    public function pengirim()
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }

    // Scope: pesan dari petugas
    public function scopeDariPetugas($query)
    {
        return $query->where('role_pengirim', 'petugas');
    }

    // Scope: pesan dari user
    public function scopeDariUser($query)
    {
        return $query->where('role_pengirim', 'user');
    }

    // Helper: apakah pengirim ini adalah petugas?
    public function isPetugas(): bool
    {
        return $this->role_pengirim === 'petugas';
    }
}
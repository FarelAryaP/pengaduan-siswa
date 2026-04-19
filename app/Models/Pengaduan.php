<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Pengaduan extends Model
{
    use HasFactory;
 
    protected $table = 'pengaduan';
 
    protected $fillable = [
        'id_user',
        'judul',
        'isi_laporan',
        'foto',
        'status',
        'tanggal_lapor',
    ];
 
    protected $casts = [
        'tanggal_lapor' => 'date',
    ];
 
    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
 
    // Relasi ke Pesan (BARU)
    public function pesan()
    {
        return $this->hasMany(Pesan::class, 'pengaduan_id')
                    ->orderBy('created_at', 'asc');
    }
 
    // Helper: jumlah pesan dari petugas yang belum dibaca (BARU)
    public function pesanBelumDibaca(): int
    {
        return $this->pesan()
                    ->where('role_pengirim', 'petugas')
                    ->where('dibaca', false)
                    ->count();
    }
}
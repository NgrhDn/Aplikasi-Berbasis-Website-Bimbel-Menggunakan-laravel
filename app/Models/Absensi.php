<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    // Tambahkan kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'user_id',
        'tanggal',
        'kelas',
        'status',
    ];

    // Jika Anda ingin melindungi semua kolom dan memilih kolom yang tidak boleh diisi:
    // protected $guarded = []; // Membuka semua kolom (gunakan dengan hati-hati)

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
}

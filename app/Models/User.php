<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'kelas', // Tambahkan kolom kelas
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (is_null($user->role_id)) {
                $user->role_id = 3; // Default siswa
            }
        });
    }


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function index()
{
    // Ambil kelas pengajar dari user yang sedang login (sesuaikan dengan kolom kelas di model User)
    $pengajar = auth()->user(); // Asumsi pengajar login
    $kelas = $pengajar->kelas; // Sesuaikan jika ada logika lain

    // Query siswa dari tabel users berdasarkan kelas
    $siswa = User::where('role_id', 3) // 3 diasumsikan sebagai role ID untuk siswa
                 ->where('kelas', $kelas)
                 ->get();

    return view('absensi.index', compact('siswa', 'kelas'));
}
}

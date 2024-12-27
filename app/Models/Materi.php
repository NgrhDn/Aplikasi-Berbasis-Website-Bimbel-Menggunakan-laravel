<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = ['pengajar_id', 'kelas', 'judul', 'file'];

    public function user()
    {
        return $this->belongsTo(User::class, 'pengajar_id');
    }

    

}


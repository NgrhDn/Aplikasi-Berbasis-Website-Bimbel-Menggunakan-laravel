<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'class_id'];

    // Relasi ke model Kelas jika diperlukan
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'class_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = ['name'];

    public function students()
    {
        return $this->hasMany(User::class, 'class_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'class_id');
    }
}

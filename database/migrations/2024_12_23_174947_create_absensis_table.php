<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensisTable extends Migration
{
    public function up()
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke tabel users
            $table->date('tanggal'); // Tanggal absensi
            $table->string('status'); // Hadir, Izin, Sakit, dll.
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('absensis');
    }
}

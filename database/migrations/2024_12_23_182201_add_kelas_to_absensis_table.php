<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKelasToAbsensisTable extends Migration
{
    public function up()
    {
        Schema::table('absensis', function (Blueprint $table) {
            $table->integer('kelas')->after('tanggal');
        });
    }

    public function down()
    {
        Schema::table('absensis', function (Blueprint $table) {
            $table->dropColumn('kelas');
        });
    }
}

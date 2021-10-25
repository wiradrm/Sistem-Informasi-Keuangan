<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_siswa', function (Blueprint $table) {
            $table->bigIncrements('siswa_id');
            $table->integer('nis')->unique();
            $table->integer('kode_spp');
            $table->integer('no_kelas');
            $table->string('nama_siswa', 100);
            $table->date('ttl');
            $table->string('alamat', 100);
            $table->string('jenis_kelamin', 20);
            $table->string('no_hp', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_siswa');
    }
}

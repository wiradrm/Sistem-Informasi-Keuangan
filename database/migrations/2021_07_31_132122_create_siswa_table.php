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
            $table->bigInteger('nisn')->unique();
            $table->string('nama_siswa', 100);
            $table->string('tempat', 100);
            $table->date('tanggal');
            $table->string('angkatan', 100);
            $table->string('alamat', 100);
            $table->string('jenis_kelamin', 20);
            $table->integer('status')->default(1);
            $table->timestamps();
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

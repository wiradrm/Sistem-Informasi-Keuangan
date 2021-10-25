<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_anggaran', function (Blueprint $table) {
            $table->bigIncrements('anggaran_id');
            $table->integer('no_anggaran')->unique();
            $table->integer('kode_spp');
            $table->string('username');
            $table->string('jenis_anggaran');
            $table->string('jumlah_bayar');
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
        Schema::dropIfExists('tb_anggaran');
    }
}

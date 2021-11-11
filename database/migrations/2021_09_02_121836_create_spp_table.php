<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_spp', function (Blueprint $table) {
            $table->bigIncrements('spp_id');
            $table->integer('kode_spp')->unique();
            $table->integer('no_anggaran');
            $table->string('jenis_transaksi');
            $table->string('bulan');
            $table->string('jumlah_bayar');
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
        Schema::dropIfExists('tb_spp');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBayarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_bayar', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('nisn');
            $table->integer('kode_spp');
            $table->string('bulan');
            $table->string('jumlah');
            $table->string('status_transaksi');
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
        Schema::dropIfExists('tb_bayar');
    }
}

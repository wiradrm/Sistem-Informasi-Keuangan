<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_monitoring_order', function (Blueprint $table) {
            $table->bigIncrements('order_id');
            $table->dateTime('tgl_ps');
            $table->integer('transaksi_id');
            $table->integer('status_transaksi_id');
            $table->integer('user_id');
            $table->integer('inputer_id');
            $table->bigInteger('pelanggan_id');
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
        Schema::dropIfExists('tb_monitoring_order');
    }
}

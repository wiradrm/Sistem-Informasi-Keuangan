<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pelanggan_id');
            $table->integer('user_id');
            $table->integer('transaksi_id');
            $table->longText('messages');
            $table->integer('approve_status')->default(1);
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
        Schema::dropIfExists('tb_requests');
    }
}

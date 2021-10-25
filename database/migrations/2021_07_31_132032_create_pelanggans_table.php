<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelanggansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pelanggan', function (Blueprint $table) {
            $table->bigIncrements('nipnas');
            $table->string('nama_pelanggan', 50);
            $table->integer('user_id');
            $table->integer('ba');
            $table->string('sid');
            $table->string('email_pelanggan', 50);
            $table->string('phone', 20);
            $table->string('alamat', 250);
            $table->string('latitude', 100);
            $table->string('longitude', 100);
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
        Schema::dropIfExists('tb_pelanggan');
    }
}

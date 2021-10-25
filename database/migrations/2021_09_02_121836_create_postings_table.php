<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_posting_kegiatan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_kegiatan', 100);
            $table->longText('keterangan');
            $table->bigInteger('pelanggan_id');
            $table->integer('user_id');
            $table->string('img', 100)->nullable();
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
        Schema::dropIfExists('tb_posting_kegiatan');
    }
}

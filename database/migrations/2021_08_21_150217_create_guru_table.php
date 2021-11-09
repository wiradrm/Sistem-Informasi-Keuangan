<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuruTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_guru', function (Blueprint $table) {
            $table->bigIncrements('guru_id');
            $table->integer('nip')->unique();
            $table->integer('no_kelas');
            $table->string('nama_guru');
            $table->date('ttl');
            $table->string('jenis_kelamin', 20);
            $table->string('bidang_studi', 40);
            $table->string('alamat', 100);
            $table->string('no_hp', 20);
            $table->integer('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_guru');
    }
}

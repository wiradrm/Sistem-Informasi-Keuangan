<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type');
            $table->integer('user_id');
            $table->integer('request_id');
            $table->integer('status')->default(1);
            $table->integer('read')->default(1);
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
        Schema::dropIfExists('tb_notifications');
    }
}

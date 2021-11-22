<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_room', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->integer('tipe_id')->unsigned();
            $table->string('nama_apartment',50)->nullable();
            $table->integer('harga')->nullable();
            $table->text('alamat')->nullable();
            $table->text('gambar')->nullable();
            $table->integer('ukuran')->nullable();
            $table->string('kamar_tidur',50)->nullable();
            $table->string('kamar_mandi',50)->nullable();
            $table->date('waktu_posting')->nullable();
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
        Schema::dropIfExists('tb_room');
    }
}

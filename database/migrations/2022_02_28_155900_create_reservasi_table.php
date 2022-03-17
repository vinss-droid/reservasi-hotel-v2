<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pemesan');
            $table->foreign('id_pemesan')->references('id')->on('pemesan')->onDelete('cascade');
            $table->unsignedBigInteger('id_kamar');
            $table->foreign('id_kamar')->references('id')->on('kamar')->onDelete('cascade');
            // $table->bigInteger('id_kamar');
            $table->string('tgl_reservasi');
            $table->string('tgl_checkin');
            $table->string('tgl_checkout');
            $table->string('nama_tamu');
            $table->bigInteger('jumlah_kamar');
            $table->bigInteger('selesai');
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
        Schema::dropIfExists('reservasi');
    }
}

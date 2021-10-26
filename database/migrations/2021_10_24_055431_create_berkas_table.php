<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBerkasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berkas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nomor_ijazah');
            $table->string('tanggal_legalisir');
            $table->string('nama_sekolah');
            $table->string('file_arsip');
            $table->unsignedBigInteger('id_periode');
            $table->unsignedBigInteger('id_jenjang');
            $table->foreign('id_periode')->references('id')->on('periode')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_jenjang')->references('id')->on('jenjang')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('berkas');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeteransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meterans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_pelanggan');
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggans')->onDelete('cascade');
            // 
            $table->unsignedBigInteger('id_petugas');
            $table->foreign('id_petugas')->references('id_petugas')->on('petugas')->onDelete('cascade');
            $table->double('jumlah_meteran');
            $table->date('date');
            $table->double('hargae');
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
        Schema::dropIfExists('meterans');
    }
}

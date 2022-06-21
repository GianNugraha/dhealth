<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resep_m', function (Blueprint $table) {
            $table->increments('resep_id')->length(11);
            $table->tinyInteger('obat_id')->references('obatalkes_id')->on('obatalkes_m');
            $table->tinyInteger('pemesanan_id')->references('pesanan_id')->on('pemesanan_m');
            $table->double('qty_obat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resep_m');
    }
}

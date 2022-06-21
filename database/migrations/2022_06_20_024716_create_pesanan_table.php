<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan_m', function (Blueprint $table) {
            $table->increments('pesanan_id')->length(11);
            $table->string('nama_pesanan',255);
            $table->boolean('is_resep');
            $table->tinyInteger('obat_id')->references('obatalkes_id')->on('obatalkes_m')->nullable()->default;
            $table->tinyInteger('user_id')->references('id')->on('tbl_user');
            $table->double('qty_obat')->nullable();
            $table->tinyInteger('signa_id')->references('signa_id')->on('signa_m');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan_m');
    }
}

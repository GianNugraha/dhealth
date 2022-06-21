<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obatalkes_m', function (Blueprint $table) {
            $table->increments('obatalkes_id')->length(11);
            $table->string('obatalkes_kode',255);
            $table->string('obatalkes_nama',255);
            $table->integer('stok')->length(11);
            $table->string('additional_data',255);
            $table->timestamp('created_date')->nullable();
            $table->char('created_by', 100);
            $table->integer('modified_count')->nullable()->default(null);
            $table->timestamp('last_modified_date')->nullable()->default(null);         
            $table->char('last_modified_by')->nullable()->default(null);
            $table->boolean('is_deleted')->default(0);
            $table->boolean('is_active')->default(1);    
            $table->char('deleted_by');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obatalkes_m');
    }
}

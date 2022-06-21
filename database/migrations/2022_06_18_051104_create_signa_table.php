<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signa_m', function (Blueprint $table) {
            $table->increments('signa_id')->length(11);
            $table->string('signa_kode',255);
            $table->string('signa_nama',255);
            $table->string('additional_data',255);
            $table->timestamp('created_date')->nullable();
            $table->char('created_by', 100);
            $table->integer('modified_count');
            $table->timestamp('last_modified_date')->nullable()->default(null);          
            $table->char('last_modified_by');
            $table->boolean('is_deleted')->default(0);
            $table->boolean('is_active')->default(1);
            $table->timestamp('deleted_date')->nullable()->default(null);                
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
        Schema::dropIfExists('signa_m');
    }
}

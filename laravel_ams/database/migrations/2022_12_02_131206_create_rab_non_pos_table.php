<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rab_non_pos', function (Blueprint $table) {
            $table->id();
            $table->foreignId("non_po_id");
            $table->string("uraian");
            $table->string("satuan");
            $table->double("volume");
            $table->double("harga_satuan");            
            $table->double("jumlah_harga");            
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
        Schema::dropIfExists('rab_non_pos');
    }
};

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
        Schema::create('rincian_induks', function (Blueprint $table) {
            $table->id();

            // $table->unsignedBigInteger('kontraks_id')->nullable();
            // $table->foreign('kontraks_id')->references('id')->on('item_rincian_induks');


            $table->foreignId('kategori_id')->nullable();            
            $table->string('nama_item');
            $table->string('satuan');
            $table->integer('harga_satuan');
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
        Schema::dropIfExists('rincian_induks');
    }
};

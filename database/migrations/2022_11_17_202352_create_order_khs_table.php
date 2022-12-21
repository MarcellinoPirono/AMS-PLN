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
        Schema::create('order_khs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rab_id');
            $table->string('kategori_order');
            $table->foreignId('item_order');
            $table->foreignId('satuan_id');
            $table->double('harga_satuan');
            $table->double('volume');
            $table->double('jumlah_harga');
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
        Schema::dropIfExists('order_khs');
    }
};

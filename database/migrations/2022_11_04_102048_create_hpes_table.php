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
        Schema::create('hpes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rab_id')->nullable();
            $table->integer('harga_perkiraan');
            $table->integer('jumlah_harga_perkiraan');
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
        Schema::dropIfExists('hpes');
    }
};

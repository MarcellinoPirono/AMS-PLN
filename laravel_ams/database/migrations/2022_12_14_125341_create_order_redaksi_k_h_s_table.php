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
        Schema::create('order_redaksi_k_h_s', function (Blueprint $table) {

            $table->id();
            $table->foreignId('rab_id');
            $table->foreignId('redaksi_id');
            $table->text('deskripsi_id');
            $table->text('sub_deskripsi_id')->nullable();
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
        Schema::dropIfExists('order_redaksi_k_h_s');
    }
};

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
            $table->foreignId('non_po_id');
            $table->double('total_harga_hpe');
            $table->string("pdf_file");
            // $table->double('jumlah_harga_perkiraan');
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

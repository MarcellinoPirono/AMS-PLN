<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Model\PaketPekerjaan;

class PaketPekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaketPekerjaan::create([
            'nama_paket' => 'Tiang Besi 11 Meter / 200 daN',
            'slug' => '-',
            'khs_id' => '2',
            'item_id' => '768',
            'volume' => '1',
            'jumlah_harga' => '170300',
        ]);

    //     public function up()
    // {
    //     Schema::create('paket_pekerjaans', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('nama_paket');
    //         $table->string('slug');
    //         $table->foreignId('khs_id');
    //         $table->foreignId('item_id')->nullable();

    //         $table->double('volume');
    //         $table->string('jumlah_harga');
    //         $table->timestamps();
    //     });
    // }

    }
}

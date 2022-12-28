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
        PaketPekerjaan::create([
            'nama_paket' => 'Tiang Besi 11 Meter / 200 daN',
            'slug' => '-',
            'khs_id' => '2',
            'item_id' => '768',
            'volume' => '1',
            'jumlah_harga' => '243890',
        ]);
        PaketPekerjaan::create([
            'nama_paket' => 'Tiang Besi 11 Meter / 200 daN',
            'slug' => '-',
            'khs_id' => '2',
            'item_id' => '768',
            'volume' => '1',
            'jumlah_harga' => '267900',
        ]);
        PaketPekerjaan::create([
            'nama_paket' => 'Tiang Besi 11 Meter / 200 daN',
            'slug' => '-',
            'khs_id' => '2',
            'item_id' => '768',
            'volume' => '1',
            'jumlah_harga' => ' 1076490',
        ]);
        PaketPekerjaan::create([
            'nama_paket' => 'Penarikan kawat JTM 3 phasa ( HIC 150 mm2)',
            'slug' => '-',
            'khs_id' => '2',
            'item_id' => '768',
            'volume' => '6',
            'jumlah_harga' => ' 109390',
        ]);
        PaketPekerjaan::create([
            'nama_paket' => 'Penarikan kawat JTM 3 phasa ( HIC 150 mm2)',
            'slug' => '-',
            'khs_id' => '2',
            'item_id' => '768',
            'volume' => '1',
            'jumlah_harga' => '7768140',
        ]);
        PaketPekerjaan::create([
            'nama_paket' => 'Penarikan kawat JTM 3 phasa ( HIC 150 mm2)',
            'slug' => '-',
            'khs_id' => '2',
            'item_id' => '768',
            'volume' => '6',
            'jumlah_harga' => '157920',
        ]);

        PaketPekerjaan::create([
            'nama_paket' => 'Penarikan kawat JTM 3 phasa ( HIC 70 mm2)',
            'slug' => '-',
            'khs_id' => '2',
            'item_id' => '768',
            'volume' => '6',
            'jumlah_harga' => '854520',
        ]);
        PaketPekerjaan::create([
            'nama_paket' => 'Penarikan kawat JTM 3 phasa ( HIC 70 mm2)',
            'slug' => '-',
            'khs_id' => '2',
            'item_id' => '768',
            'volume' => '1',
            'jumlah_harga' => ' 6473450
            ',
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

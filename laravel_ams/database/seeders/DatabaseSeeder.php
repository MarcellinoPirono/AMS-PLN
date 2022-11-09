<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ItemRincianInduk;
use App\Models\RincianInduk;
use App\Models\Skk;
use App\Models\Prk;
use App\Models\Rab;
use App\Models\Hpe;
use App\Models\Pejabat;
use App\Models\KontrakInduk;
use App\Models\Khs;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // ItemRincianInduk::factory(20)->create();
        // RincianInduk::factory(20)->create();
        Skk::factory(20)->create();
        Prk::factory(20)->create();
        Rab::factory(20)->create();
        Hpe::factory(20)->create();
        Pejabat::factory(20)->create();
        // KontrakInduk::factory(20)->create();
        // Khs::factory(2)->create();

        Khs::create([
            'jenis_khs' => 'SP/APP',
        ]);

        Khs::create(
            [
                'jenis_khs' => 'JTM',
            ]
        );

        KontrakInduk::create([
            'nomor_kontrak_induk' => '801/01.AGA.03/',
            'khs_id' => '1',
            'nama_vendor' => 'PT ABC'
        ]);

        KontrakInduk::create([
            'nomor_kontrak_induk' => '506/02.AGA.04/',
            'khs_id' => '2',
            'nama_vendor' => 'PT XYZ'
        ]);

        
        ItemRincianInduk::create([
            'nama_kategori' => 'Pemasangan SP 1 Phasa',
            'khs_id' => '1'
        ]);
        ItemRincianInduk::create([
            'nama_kategori' => 'Pemasangan / Penarikan SP 3 Phasa',
            'khs_id' => '1'
        ]);
        ItemRincianInduk::create([
            'nama_kategori' => 'Pembongkaran',
            'khs_id' => '1'
        ]);
        ItemRincianInduk::create([
            'nama_kategori' => 'Pemeliharaan',
            'khs_id' => '1'
        ]);
        ItemRincianInduk::create([
            'nama_kategori' => 'Pekerjaan Jasa Lainnya',
            'khs_id' => '1'
        ]);
        ItemRincianInduk::create([
            'nama_kategori' => 'Pemasangan',
            'khs_id' => '2'
        ]);
        ItemRincianInduk::create([
            'nama_kategori' => 'Pembongkaran',
            'khs_id' => '2'
        ]);        

        RincianInduk::create([
            'kategori_id' => '1',
            'nama_item' => 'Penarikan Kabel TIC 2x10 mm2',
            'satuan' => 'plg',
            'harga_satuan' => '31980'            
        ]);
        RincianInduk::create([
            'kategori_id' => '1',
            'nama_item' => 'Pemasangan APP 1 phasa',
            'satuan' => 'set',
            'harga_satuan' => '45940'                        
        ]);
        RincianInduk::create([
            'kategori_id' => '2',
            'nama_item' => 'Penarikan Kabel 3 phasa',
            'satuan' => 'plg',
            'harga_satuan' => '63960'            
        ]);
        RincianInduk::create([
            'kategori_id' => '3',
            'nama_item' => 'Pembongkaran Kabel 1 phasa',
            'satuan' => 'plg',
            'harga_satuan' => '15990'            
        ]);
        RincianInduk::create([
            'kategori_id' => '3',
            'nama_item' => 'Pembongkaran CT TR',
            'satuan' => 'plg',
            'harga_satuan' => '15990'            
        ]);
        RincianInduk::create([
            'kategori_id' => '6',
            'nama_item' => 'Penggalian tanah untuk pemancagan tiang TM (tanah)',
            'satuan' => 'lubang',
            'harga_satuan' => '170300'            
        ]);
        RincianInduk::create([
            'kategori_id' => '7',
            'nama_item' => 'Pencabutan tiang besi',
            'satuan' => 'batang',
            'harga_satuan' => '256300'            
        ]);        
    }
}

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
use App\Models\Vendor;
use App\Models\Addendum;
use App\Models\Satuan;
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
        // Hpe::factory(20)->create();
        // Pejabat::factory(20)->create();
        // KontrakInduk::factory(20)->create();
        // Khs::factory(2)->create();

        Khs::create([
            'jenis_khs' => 'SP-APP',
            'nama_pekerjaan' => 'Pengadaan Jasa Konstruksi dan Pemeliharaan SP & APP Dengan Pola Kesepakatan Harga Satuan (KHS) Tahun 2020/2021',
        ]);

        Khs::create(
            [
                'jenis_khs' => 'JTM',
                'nama_pekerjaan' => 'Pengadaan Jasa Konstruksi dan Pemeliharaan JTM, Gardu Distribusi, JTR Dengan Pola Kesepakatan Harga Satuan (KHS) Tahun 2020/2021',
            ]
        );

        // 
        // ItemRincianInduk::create([
        //     'nama_kategori' => 'Jasa',
        //     'khs_id' => '1'
        // ]);
        // ItemRincianInduk::create([
        //     'nama_kategori' => 'Material',
        //     'khs_id' => '2'
        // ]);  
        
        // Item
        RincianInduk::create([
            'khs_id' => '1',
            'kategori' => 'Jasa',
            'nama_item' => 'Penarikan Kabel TIC 2x10 mm2',
            'satuan' => 'plg',
            'harga_satuan' => '31980'            
        ]);
        RincianInduk::create([
            'khs_id' => '1',
            'kategori' => 'Jasa',
            'nama_item' => 'Pemasangan APP 1 phasa',
            'satuan' => 'set',
            'harga_satuan' => '45940'                        
        ]);
        RincianInduk::create([
            'khs_id' => '1',
            'kategori' => 'Jasa',
            'nama_item' => 'Penarikan Kabel 3 phasa',
            'satuan' => 'plg',
            'harga_satuan' => '63960'            
        ]);
        RincianInduk::create([
            'khs_id' => '1',
            'kategori' => 'Jasa',
            'nama_item' => 'Pembongkaran Kabel 1 phasa',
            'satuan' => 'plg',
            'harga_satuan' => '15990'            
        ]);
        RincianInduk::create([
            'khs_id' => '1',
            'kategori' => 'Jasa',
            'nama_item' => 'Pembongkaran CT TR',
            'satuan' => 'plg',
            'harga_satuan' => '15990'            
        ]);
        RincianInduk::create([
            'khs_id' => '1',
            'kategori' => 'Jasa',
            'nama_item' => 'Penggalian tanah untuk pemancagan tiang TM (tanah)',
            'satuan' => 'lubang',
            'harga_satuan' => '170300'            
        ]);
        RincianInduk::create([
            'khs_id' => '1',
            'kategori' => 'Jasa',
            'nama_item' => 'Pencabutan tiang besi',
            'satuan' => 'batang',
            'harga_satuan' => '256300'            
        ]);
        RincianInduk::create([
            'khs_id' => '2',
            'kategori' => 'Material',
            'nama_item' => 'Timah Segel / kg ( 12 mm )',
            'satuan' => 'roll',
            'harga_satuan' => '56816'            
        ]);
        RincianInduk::create([
            'khs_id' => '2',
            'kategori' => 'Material' ,       
            'nama_item' => 'Kawat Segel / roll',
            'satuan' => 'roll',
            'harga_satuan' => '63132'            
        ]);
        
        Vendor::create([
            'nama_vendor' => 'PT ABC',
            'nama_direktur' => 'Arfandy Adimurfiq',
            'alamat_kantor_1' => 'Kantor BPTP, JL. P. Kemerdekaan KM 17,5',
            'alamat_kantor_2' => 'Bumi Permata Sudiang Blok I1. No.22',
            'no_rek_1' => '123456789',            
            'nama_bank_1' => 'Bank BCA',            
            'no_rek_2' => '987654321',            
            'nama_bank_2' => 'Bank BNI',            
            'npwp' => '000123456789',            
        ]);
        Vendor::create([
            'nama_vendor' => 'PT XYZ',
            'nama_direktur' => 'Fadhil KH',
            'alamat_kantor_1' => 'Kampus Teknik Unhas Gowa, Bontomarannu',
            'alamat_kantor_2' => 'Kampus Unhas Makassar, Tamalanrea',
            'no_rek_1' => '111222333',            
            'nama_bank_1' => 'Bank BCA',            
            'no_rek_2' => '333222111',            
            'nama_bank_2' => 'Bank BNI',            
            'npwp' => '111123456789',            
        ]);
        
        KontrakInduk::create([
            'khs_id' => '1',
            'nomor_kontrak_induk' => '0029.PJ/DAN.01.04/161000/2020',
            'tanggal_kontrak_induk' => '01 April 2020',
            'nama_vendor' => 'PT. Distribusi Energi Mandiri'            
        ]);
        KontrakInduk::create([
            'khs_id' => '2',
            'nomor_kontrak_induk' => '0030.PJ/DAN.02.05/171000/2021',
            'tanggal_kontrak_induk' => '09 Mei 2021',
            'nama_vendor' => 'PT. ABC'            
        ]);

        Pejabat::create([
            'nama_pejabat' => 'Nurdhita Fahira',
            'jabatan' => 'Manager UP3',
            'unit_up3' => 'UP3 Makassar Selatan',
            'unit_ulp' => '-'            
        ]);
        Pejabat::create([
            'nama_pejabat' => 'Marcellino Pirono',
            'jabatan' => 'Manager Bagian Transaksi Energi',
            'unit_up3' => 'UP3 Makassar Selatan',
            'unit_ulp' => '-'            
        ]);
        Pejabat::create([
            'nama_pejabat' => 'Muh. Rajab Israfil',
            'jabatan' => 'Manager Bagian REN',
            'unit_up3' => 'UP3 Makassar Selatan',
            'unit_ulp' => '-'            
        ]);
        
        Addendum::create([            
            'kontrak_induk_id' => '1',
            'nomor_addendum' => '023/DAN/2020',
            'tanggal_addendum' => '2022-11-15'            
        ]);
        Addendum::create([            
            'kontrak_induk_id' => '1',
            'nomor_addendum' => '024/DAN/2020',
            'tanggal_addendum' => '2022-11-16'            
        ]);
        Addendum::create([            
            'kontrak_induk_id' => '1',
            'nomor_addendum' => '025/DAN/2020',
            'tanggal_addendum' => '2022-11-17'            
        ]);

        Satuan::create([            
            'singkatan' => 'm',
            'kepanjangan' => 'meter',                     
        ]);
        Satuan::create([            
            'singkatan' => 'lbg',
            'kepanjangan' => 'lubang',                     
        ]);
        Satuan::create([            
            'singkatan' => 'btg',
            'kepanjangan' => 'batang',                     
        ]);
    }
}

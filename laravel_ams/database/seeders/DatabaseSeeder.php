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
use App\Models\Redaksi;
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
        // Skk::factory(20)->create();
        // Prk::factory(20)->create();
        // Rab::factory(20)->create();
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
            'satuan_id' => '1',
            'harga_satuan' => '31980'            
        ]);
        RincianInduk::create([
            'khs_id' => '1',
            'kategori' => 'Jasa',
            'nama_item' => 'Pemasangan APP 1 phasa',
            'satuan_id' => '2',
            'harga_satuan' => '45940'                        
        ]);
        RincianInduk::create([
            'khs_id' => '1',
            'kategori' => 'Jasa',
            'nama_item' => 'Penarikan Kabel 3 phasa',
            'satuan_id' => '3',
            'harga_satuan' => '63960'            
        ]);
        RincianInduk::create([
            'khs_id' => '1',
            'kategori' => 'Jasa',
            'nama_item' => 'Pembongkaran Kabel 1 phasa',
            'satuan_id' => '1',
            'harga_satuan' => '15990'            
        ]);
        RincianInduk::create([
            'khs_id' => '1',
            'kategori' => 'Jasa',
            'nama_item' => 'Pembongkaran CT TR',
            'satuan_id' => '2',
            'harga_satuan' => '15990'            
        ]);
        RincianInduk::create([
            'khs_id' => '1',
            'kategori' => 'Jasa',
            'nama_item' => 'Penggalian tanah untuk pemancagan tiang TM (tanah)',
            'satuan_id' => '3',
            'harga_satuan' => '170300'            
        ]);
        RincianInduk::create([
            'khs_id' => '1',
            'kategori' => 'Jasa',
            'nama_item' => 'Pencabutan tiang besi',
            'satuan_id' => '1',
            'harga_satuan' => '256300'            
        ]);
        RincianInduk::create([
            'khs_id' => '2',
            'kategori' => 'Material',
            'nama_item' => 'Timah Segel / kg ( 12 mm )',
            'satuan_id' => '2',
            'harga_satuan' => '56816'            
        ]);
        RincianInduk::create([
            'khs_id' => '2',
            'kategori' => 'Material' ,       
            'nama_item' => 'Kawat Segel / roll',
            'satuan_id' => '3',
            'harga_satuan' => '63132'            
        ]);

        Vendor::create([
            'nama_vendor' => 'PT. Distribusi Energi Mandiri',
            'nama_direktur' => 'Ir. H. Murjani',
            'alamat_kantor_1' => 'Jl. Cendrawasih KOMP. RUKO CENDRAWASIH SQUARE O. C18, Makassar',
            'alamat_kantor_2' => 'Jl. Cendrawasih',
            'no_rek_1' => '555555555',            
            'nama_bank_1' => 'Bank BSI',            
            'no_rek_2' => '66666666',            
            'nama_bank_2' => 'Bank BI',            
            'npwp' => '0892318349273',            
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
            'tanggal_kontrak_induk' => '2020-04-01',
            'vendor_id' => '1'            
        ]);
        KontrakInduk::create([
            'khs_id' => '2',
            'nomor_kontrak_induk' => '0030.PJ/DAN.02.05/171000/2021',
            'tanggal_kontrak_induk' => '2021-05-09',
            'vendor_id' => '2'            
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


        Redaksi::create([            
            'nama_redaksi' => 'Surat Perjanjian',
            'deskripsi_redaksi' => 'Surat Perjanjian',                     
        ]);


        Redaksi::create([
            'nama_redaksi' => 'Surat Perjanjian2',
            'deskripsi_redaksi' => 'Surat Perjanjian2',
        ]);
        Redaksi::create([
            'nama_redaksi' => 'Surat Perjanjian3',
            'deskripsi_redaksi' => 'Surat Perjanjian3',
        ]);

        Skk::create([
            'nomor_skk' => '020/DAN/2020',
            'uraian_skk' => 'Pembelian Motor',
            'pagu_skk' => '0',
            'skk_terkontrak' => '0',
            'skk_realisasi' => '0',
            'skk_terbayar' => '0',
            'skk_sisa' => '0',
        ]);
        Skk::create([
            'nomor_skk' => '021/DAN/2021',
            'uraian_skk' => 'Pembelian Mobil',
            'pagu_skk' => '12000000000',
            'skk_terkontrak' => '0',
            'skk_realisasi' => '0',
            'skk_terbayar' => '0',
            'skk_sisa' => '0',
        ]);
        Skk::create([
            'nomor_skk' => '022/DAN/2022',
            'uraian_skk' => 'Pembelian Skuter',
            'pagu_skk' => '5000000000',
            'skk_terkontrak' => '0',
            'skk_realisasi' => '0',
            'skk_terbayar' => '0',
            'skk_sisa' => '0',
        ]);
        
        Prk::create([
            'no_skk_prk' => '1',
            'no_prk' => '001/DAN.PRK/2020',
            'uraian_prk' => 'Pembelian Ban',
            'pagu_prk' => '0',
            'prk_terkontrak' => '0',
            'prk_realisasi' => '0',
            'prk_terbayar' => '0',
            'prk_sisa' => '0',
        ]);
        Prk::create([
            'no_skk_prk' => '1',
            'no_prk' => '002/DAN.PRK/2020',
            'uraian_prk' => 'Pembelian Velg',
            'pagu_prk' => '500000000',
            'prk_terkontrak' => '20000000',
            'prk_realisasi' => '0',
            'prk_terbayar' => '0',
            'prk_sisa' => '0',
        ]);
        Prk::create([
            'no_skk_prk' => '1',
            'no_prk' => '003/DAN.PRK/2020',
            'uraian_prk' => 'Pembelian Spion',
            'pagu_prk' => '350000000',
            'prk_terkontrak' => '50000000',
            'prk_realisasi' => '0',
            'prk_terbayar' => '0',
            'prk_sisa' => '0',
        ]);
        Prk::create([
            'no_skk_prk' => '2',
            'no_prk' => '010/DAN.PRK/2021',
            'uraian_prk' => 'Pembelian Knalpot',
            'pagu_prk' => '5000000000',
            'prk_terkontrak' => '0',
            'prk_realisasi' => '0',
            'prk_terbayar' => '0',
            'prk_sisa' => '0',
        ]);
        Prk::create([
            'no_skk_prk' => '3',
            'no_prk' => '020/DAN.PRK/2022',
            'uraian_prk' => 'Pembelian Roda',
            'pagu_prk' => '450000000',
            'prk_terkontrak' => '0',
            'prk_realisasi' => '0',
            'prk_terbayar' => '0',
            'prk_sisa' => '0',
        ]);
        
        
        
    }
}

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
use App\Models\User;
use App\Models\PpnModel;
use Illuminate\Support\Str;
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

        $this->call([
            SatuanSeeder::class,
            RedaksiSeeder::class,
            RedaksiNotaDinasSeeder::class,
            PejabatSeeder::class,
            SubRedaksiSeeder::class,
            KlasifikasiSeeder::class
        ]);
        PpnModel::create([
            'ppn' => 11,
        ]);

        User::create([
            'name'=> 'Administrator',
            'username' => 'administrator',
            'password' => bcrypt('Administrator@123'),
            'role'=>'Admin',
            'email'=>'administrator@gmail.com',
            'no_hp'=>'08123456789',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),

        ]);
        User::create([
            'name'=> 'Keuangan',
            'username' => 'keuangan',
            'password' => bcrypt('keuangan'),
            'role'=>'Keuangan',
            'email'=>'Keuangan@gmail.com',
            'no_hp'=>'08123456789',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),

        ]);
        User::create([
            'name'=> 'Manager',
            'username' => 'manager',
            'password' => bcrypt('manager'),
            'role'=>'Manager',
            'email'=>'manager@gmail.com',
            'no_hp'=>'08123456789',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),

        ]);
        User::create([
            'name'=> 'REN',
            'username' => 'perencanaan',
            'password' => bcrypt('perencanaan'),
            'role'=>'REN',
            'email'=>'perencanaan@gmail.com',
            'no_hp'=>'08123456789',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),

        ]);
        User::create([
            'name'=> 'Fadhil',
            'username' => 'dhil',
            'password' => bcrypt('dhilkh@123'),
            'role'=>'Supervisor',
            'email'=>'dhilkh@gmail.com',
            'no_hp'=>'0812666779',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'pic_profile'=>'storage/Image-profile/d.png',

        ]);

        Khs::create([
            'jenis_khs' => 'SP-APP',
            'nama_pekerjaan' => 'Pengadaan Jasa Konstruksi dan Pemeliharaan SP & APP Dengan Pola Kesepakatan Harga Satuan (KHS) Tahun 2020/2021',
            'isActive' => True,
        ]);


        Khs::create(
            [
                'jenis_khs' => 'JTM',
                'nama_pekerjaan' => 'Pengadaan Jasa Konstruksi dan Pemeliharaan JTM, Gardu Distribusi, JTR Dengan Pola Kesepakatan Harga Satuan (KHS) Tahun 2020/2021',
                'isActive' => True,
            ]
        );



        ItemRincianInduk::create([
            'nama_kategori' => 'Jasa',
            'khs_id' => '1'
        ]);
        ItemRincianInduk::create([
            'nama_kategori' => 'Material',
            'khs_id' => '2'
        ]);


        // RincianInduk::create([
        //     'khs_id' => '1',
        //     'kategori' => 'Jasa',
        //     'nama_item' => 'Penarikan Kabel TIC 2x10 mm2',
        //     'satuan_id' => '1',
        //     'harga_satuan' => '31980'
        // ]);
        // RincianInduk::create([
        //     'khs_id' => '1',
        //     'kategori' => 'Jasa',
        //     'nama_item' => 'Pemasangan APP 1 phasa',
        //     'satuan_id' => '2',
        //     'harga_satuan' => '45940'
        // ]);
        // RincianInduk::create([
        //     'khs_id' => '1',
        //     'kategori' => 'Jasa',
        //     'nama_item' => 'Penarikan Kabel 3 phasa',
        //     'satuan_id' => '3',
        //     'harga_satuan' => '63960'
        // ]);
        // RincianInduk::create([
        //     'khs_id' => '1',
        //     'kategori' => 'Jasa',
        //     'nama_item' => 'Pembongkaran Kabel 1 phasa',
        //     'satuan_id' => '1',
        //     'harga_satuan' => '15990'
        // ]);
        // RincianInduk::create([
        //     'khs_id' => '1',
        //     'kategori' => 'Jasa',
        //     'nama_item' => 'Pembongkaran CT TR',
        //     'satuan_id' => '2',
        //     'harga_satuan' => '15990'
        // ]);
        // RincianInduk::create([
        //     'khs_id' => '1',
        //     'kategori' => 'Jasa',
        //     'nama_item' => 'Penggalian tanah untuk pemancagan tiang TM (tanah)',
        //     'satuan_id' => '3',
        //     'harga_satuan' => '170300'
        // ]);
        // RincianInduk::create([
        //     'khs_id' => '1',
        //     'kategori' => 'Jasa',
        //     'nama_item' => 'Pencabutan tiang besi',
        //     'satuan_id' => '1',
        //     'harga_satuan' => '256300'
        // ]);
        // RincianInduk::create([
        //     'khs_id' => '1',
        //     'kategori' => 'Material',
        //     'nama_item' => 'Timah Segel / kg ( 12 mm )',
        //     'satuan_id' => '2',
        //     'harga_satuan' => '56816'
        // ]);
        // RincianInduk::create([
        //     'khs_id' => '1',
        //     'kategori' => 'Material',
        //     'nama_item' => 'Kabel Panjang',
        //     'satuan_id' => '2',
        //     'harga_satuan' => '56816'
        // ]);
        // RincianInduk::create([
        //     'khs_id' => '2',
        //     'kategori' => 'Jasa',
        //     'nama_item' => 'Pencabutan tiang besi',
        //     'satuan_id' => '2',
        //     'harga_satuan' => '10020'
        // ]);
        // RincianInduk::create([
        //     'khs_id' => '2',
        //     'kategori' => 'Jasa',
        //     'nama_item' => 'Pemasangan Trafo',
        //     'satuan_id' => '2',
        //     'harga_satuan' => '200122'
        // ]);
        // RincianInduk::create([
        //     'khs_id' => '2',
        //     'kategori' => 'Material',
        //     'nama_item' => 'Timah Segel / kg ( 12 mm )',
        //     'satuan_id' => '2',
        //     'harga_satuan' => '56816'
        // ]);
        // RincianInduk::create([
        //     'khs_id' => '2',
        //     'kategori' => 'Material' ,
        //     'nama_item' => 'Kawat Segel / roll',
        //     'satuan_id' => '3',
        //     'harga_satuan' => '63132'
        // ]);

        // KontrakInduk::create([
        //     'khs_id' => '1',
        //     'nomor_kontrak_induk' => '0029.PJ/DAN.01.04/161000/2020',
        //     'tanggal_kontrak_induk' => '2020-04-01',
        //     'vendor_id' => '1'
        // ]);
        // KontrakInduk::create([
        //     'khs_id' => '2',
        //     'nomor_kontrak_induk' => '0030.PJ/DAN.02.05/171000/2021',
        //     'tanggal_kontrak_induk' => '2021-05-09',
        //     'vendor_id' => '2'
        // ]);

        // Pejabat::create([
        //     'nama_pejabat' => 'ARI TIRTAPRAWITA',
        //     'jabatan' => 'MANAGER UP3',
        //     'unit_up3' => 'UP3 MAKASSAR SELATAN',
        //     'unit_ulp' => '-',
        // ]);
        // Pejabat::create([
        //     'nama_pejabat' => 'PRADIKTA CENDIKA',
        //     'jabatan' => 'ASISTANT MANAGER TRANSAKSI ENERGI LISTRIK',
        //     'unit_up3' => 'UP3 MAKASSAR SELATAN',
        //     'unit_ulp' => '-',
        // ]);
        // Pejabat::create([
        //     'nama_pejabat' => 'YANUARDHI AB',
        //     'jabatan' => 'ASISTANT MANAGER PERENCANAAN',
        //     'unit_up3' => 'UP3 MAKASSAR SELATAN',
        //     'unit_ulp' => '-',
        // ]);
        // Pejabat::create([
        //     'nama_pejabat' => 'RAMLI',
        //     'jabatan' => 'ASISTANT MANAGER KONSTRUKSI',
        //     'unit_up3' => 'UP3 MAKASSAR SELATAN',
        //     'unit_ulp' => '-',
        // ]);
        // Pejabat::create([
        //     'nama_pejabat' => 'KHALID HUSAIN',
        //     'jabatan' => 'ASISTANT MANAGER JARINGAN',
        //     'unit_up3' => 'UP3 MAKASSAR SELATAN',
        //     'unit_ulp' => '-',
        // ]);
        // Pejabat::create([
        //     'nama_pejabat' => 'LATIF PRASETYOHADI',
        //     'jabatan' => 'ASISTANT MANAGER PEMASARAN DAN PELAYANAN PELANGGAN',
        //     'unit_up3' => 'UP3 MAKASSAR SELATAN',
        //     'unit_ulp' => '-',
        // ]);
        // Pejabat::create([
        //     'nama_pejabat' => 'JOHAN PRASETYA YUDHA PRAMUKTI',
        //     'jabatan' => 'ASISTANT MANAGER KEUANGAN ADMINISTRASI DAN UMUM',
        //     'unit_up3' => 'UP3 MAKASSAR SELATAN',
        //     'unit_ulp' => '-',
        // ]);
        // Pejabat::create([
        //     'nama_pejabat' => 'SYAHRUDDIN NUR',
        //     'jabatan' => 'TEAM LEADER KESELAMATAN, KESEHATAN KERJA, LINGKUNGAN DAN KEAMANAN',
        //     'unit_up3' => 'UP3 MAKASSAR SELATAN',
        //     'unit_ulp' => '-',
        // ]);
        // Pejabat::create([
        //     'nama_pejabat' => 'MUSTOFA KAMIL',
        //     'jabatan' => 'TEAM LEADER PELAKSANA PENGADAAN',
        //     'unit_up3' => 'UP3 MAKASSAR SELATAN',
        //     'unit_ulp' => '-',
        // ]);

        // Addendum::create([
        //     'kontrak_induk_id' => '1',
        //     'nomor_addendum' => '023/DAN/2020',
        //     'tanggal_addendum' => '2022-11-15'
        // ]);
        // Addendum::create([
        //     'kontrak_induk_id' => '1',
        //     'nomor_addendum' => '024/DAN/2020',
        //     'tanggal_addendum' => '2022-11-16'
        // ]);
        // Addendum::create([
        //     'kontrak_induk_id' => '1',
        //     'nomor_addendum' => '025/DAN/2020',
        //     'tanggal_addendum' => '2022-11-17'
        // ]);

        // Satuan::create([
        //     'singkatan' => 'm',
        //     'kepanjangan' => 'meter',
        // ]);
        // Satuan::create([
        //     'singkatan' => 'lbg',
        //     'kepanjangan' => 'lubang',
        // ]);
        // Satuan::create([
        //     'singkatan' => 'btg',
        //     'kepanjangan' => 'batang',
        // ]);




        Skk::create([
            'nomor_skk' => '020/DAN/2020',
            'uraian_skk' => 'Pembelian Motor',
            'pagu_skk' => '0',
            'ai_ao' => 'AO',
            'skk_terkontrak' => '0',
            'skk_progress' => '0',
            'skk_realisasi' => '0',
            'skk_terbayar' => '0',
            'skk_sisa' => '0',
        ]);
        Skk::create([
            'nomor_skk' => '021/DAN/2021',
            'uraian_skk' => 'Pembelian Mobil',
            'pagu_skk' => '0',
            'ai_ao' => 'AI',

            'skk_terkontrak' => '0',
            'skk_progress' => '0',
            'skk_realisasi' => '0',
            'skk_terbayar' => '0',
            'skk_sisa' => '0',
        ]);
        Skk::create([
            'nomor_skk' => '022/DAN/2022',
            'uraian_skk' => 'Pembelian Skuter',
            'pagu_skk' => '0',
            'ai_ao' => 'AI',

            'skk_terkontrak' => '0',
            'skk_progress' => '0',
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
            'prk_progress' => '0',
            'prk_progress' => '0',
            'prk_realisasi' => '0',
            'prk_terbayar' => '0',
            'prk_sisa' => '0',
        ]);
        Prk::create([
            'no_skk_prk' => '1',
            'no_prk' => '002/DAN.PRK/2020',
            'uraian_prk' => 'Pembelian Velg',
            'pagu_prk' => '0',
            'prk_terkontrak' => '0',
            'prk_progress' => '0',
            'prk_realisasi' => '0',
            'prk_terbayar' => '0',
            'prk_sisa' => '0',
        ]);
        Prk::create([
            'no_skk_prk' => '1',
            'no_prk' => '003/DAN.PRK/2020',
            'uraian_prk' => 'Pembelian Spion',
            'pagu_prk' => '0',
            'prk_terkontrak' => '0',
            'prk_progress' => '0',
            'prk_realisasi' => '0',
            'prk_terbayar' => '0',
            'prk_sisa' => '0',
        ]);
        Prk::create([
            'no_skk_prk' => '2',
            'no_prk' => '010/DAN.PRK/2021',
            'uraian_prk' => 'Pembelian Knalpot',
            'pagu_prk' => '0',
            'prk_terkontrak' => '0',
            'prk_progress' => '0',
            'prk_realisasi' => '0',
            'prk_terbayar' => '0',
            'prk_sisa' => '0',
        ]);
        Prk::create([
            'no_skk_prk' => '3',
            'no_prk' => '020/DAN.PRK/2022',
            'uraian_prk' => 'Pembelian Roda',
            'pagu_prk' => '0',
            'prk_terkontrak' => '0',
            'prk_progress' => '0',
            'prk_realisasi' => '0',
            'prk_terbayar' => '0',
            'prk_sisa' => '0',
        ]);

    }
}

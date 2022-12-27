<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KlasifikasiPaket;


class KlasifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KlasifikasiPaket::create([
            'khs_id' => 1,
            'nama_klasifikasi' => 'SP-APP',
            'kepanjangan' => 'PENGADAAN JASA KONSTRUKSI DAN PEMELIHARAAN SP & APP DENGAN POLA KESEPAKATAN HARGA SATUAN (KHS) TAHUN 2020/2021',
        ]);

        KlasifikasiPaket::create([
            'khs_id' => 2,
            'nama_klasifikasi' => 'JTR',
            'kepanjangan' => 'Jaringan Tegangan Rendah',
        ]);
        KlasifikasiPaket::create([
            'khs_id' => 2,
            'nama_klasifikasi' => 'GD',
            'kepanjangan' => 'Gardu Distribusi',
        ]);
        KlasifikasiPaket::create([
            'khs_id' => 2,
            'nama_klasifikasi' => 'JTM',
            'kepanjangan' => 'Jaringan Tegangan Menengah',
        ]);
    }
}

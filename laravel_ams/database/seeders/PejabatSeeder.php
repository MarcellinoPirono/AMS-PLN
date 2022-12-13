<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;

class PejabatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    Pejabat::create([
        'nama_pejabat' => 'ARI TIRTAPRAWITA',
        'jabatan' => 'MANAGER UP3',
        'unit_up3' => 'UP3 MAKASSAR SELATAN',
        'unit_ulp' => '-',
    ]);
    Pejabat::create([
        'nama_pejabat' => 'PRADIKTA CENDIKA',
        'jabatan' => 'ASISTANT MANAGER TRANSAKSI ENERGI LISTRIK',
        'unit_up3' => 'UP3 MAKASSAR SELATAN',
        'unit_ulp' => '-',
    ]);
    Pejabat::create([
        'nama_pejabat' => 'YANUARDHI AB',
        'jabatan' => 'ASISTANT MANAGER PERENCANAAN',
        'unit_up3' => 'UP3 MAKASSAR SELATAN',
        'unit_ulp' => '-',
    ]);
    Pejabat::create([
        'nama_pejabat' => 'RAMLI',
        'jabatan' => 'ASISTANT MANAGER KONSTRUKSI',
        'unit_up3' => 'UP3 MAKASSAR SELATAN',
        'unit_ulp' => '-',
    ]);
    Pejabat::create([
        'nama_pejabat' => 'KHALID HUSAIN',
        'jabatan' => 'ASISTANT MANAGER JARINGAN',
        'unit_up3' => 'UP3 MAKASSAR SELATAN',
        'unit_ulp' => '-',
    ]);
    Pejabat::create([
        'nama_pejabat' => 'LATIF PRASETYOHADI',
        'jabatan' => 'ASISTANT MANAGER PEMASARAN DAN PELAYANAN PELANGGAN',
        'unit_up3' => 'UP3 MAKASSAR SELATAN',
        'unit_ulp' => '-',
    ]);
    Pejabat::create([
        'nama_pejabat' => 'JOHAN PRASETYA YUDHA PRAMUKTI',
        'jabatan' => 'ASISTANT MANAGER KEUANGAN ADMINISTRASI DAN UMUM',
        'unit_up3' => 'UP3 MAKASSAR SELATAN',
        'unit_ulp' => '-',
    ]);
    Pejabat::create([
        'nama_pejabat' => 'SYAHRUDDIN NUR',
        'jabatan' => 'TEAM LEADER KESELAMATAN, KESEHATAN KERJA, LINGKUNGAN DAN KEAMANAN',
        'unit_up3' => 'UP3 MAKASSAR SELATAN',
        'unit_ulp' => '-',
    ]);
    Pejabat::create([
        'nama_pejabat' => 'MUSTOFA KAMIL',
        'jabatan' => 'TEAM LEADER PELAKSANA PENGADAAN',
        'unit_up3' => 'UP3 MAKASSAR SELATAN',
        'unit_ulp' => '-',
    ]);
    }
}

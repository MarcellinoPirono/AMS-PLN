<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vendor::create([
            'nama_vendor' => 'PT ALTIN ELEKTRONIK ABADI',
            'nama_direktur' => 'IR. BACHTIAR ALTIN',
            'alamat_kantor_1' => 'JL. SULTAN ALAUDDIN III A. NO.7 MAKASSAR',
            'alamat_kantor_2' => '-',
            'no_rek_1' => '205301000236307',
            'nama_bank_1' => 'BRI',
            'no_rek_2' => '-',
            'nama_bank_2' => '-',
            'npwp' => '732498852804000',
        ]);
        Vendor::create([
            'nama_vendor' => 'PT ARYA SABILA ELECTRIK',
            'nama_direktur' => 'HJ. ASNIAH ARIFIN, SH',
            'alamat_kantor_1' => 'JL. GUNUNG MERAPI NO.74 MAKASSAR',
            'alamat_kantor_2' => '',
            'no_rek_1' => '1740000763623',
            'nama_bank_1' => 'MANDIRI',
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
    }
}

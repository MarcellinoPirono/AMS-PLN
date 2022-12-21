<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Satuan;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Satuan::create([
            'singkatan' => 'plg',
            'kepanjangan' => 'Pelanggan',
        ]);
        Satuan::create([
            'singkatan' => 'bh',
            'kepanjangan' => 'Buah',
        ]);
        Satuan::create([
            'singkatan' => 'set',
            'kepanjangan' => 'Set',
        ]);
        Satuan::create([
            'singkatan' => 'plg',
            'kepanjangan' => 'Pelanggan',
        ]);
        Satuan::create([
            'singkatan' => 'titik',
            'kepanjangan' => 'Titik',
        ]);
        Satuan::create([
            'singkatan' => 'kg',
            'kepanjangan' => 'Kilogram',
        ]);
        Satuan::create([
            'singkatan' => 'Rp/Ton.km',
            'kepanjangan' => 'Rupiah per Tonase',
        ]);
        Satuan::create([
            'singkatan' => 'Pohon',
            'kepanjangan' => 'Pohon',
        ]);
        Satuan::create([
            'singkatan' => 'meter',
            'kepanjangan' => 'Meter',
        ]);
        Satuan::create([
            'singkatan' => 'lubang',
            'kepanjangan' => 'Lubang',
        ]);
        Satuan::create([
            'singkatan' => 'btg',
            'kepanjangan' => 'Batang',
        ]);
        Satuan::create([
            'singkatan' => 'Kms',
            'kepanjangan' => 'Kilometer sirkit',
        ]);
        Satuan::create([
            'singkatan' => 'panel',
            'kepanjangan' => 'Panel',
        ]);
        Satuan::create([
            'singkatan' => 'ls',
            'kepanjangan' => 'Lumpsum',
        ]);
        Satuan::create([
            'singkatan' => 'gawang',
            'kepanjangan' => 'Gawang',
        ]);
        Satuan::create([
            'singkatan' => 'gr',
            'kepanjangan' => 'Gram',
        ]);
        Satuan::create([
            'singkatan' => 'roll',
            'kepanjangan' => 'Roll',
        ]);
        Satuan::create([
            'singkatan' => 'sel',
            'kepanjangan' => 'Sel',
        ]);
        Satuan::create([
            'singkatan' => 'liter',
            'kepanjangan' => 'Liter',
        ]);
        Satuan::create([
            'singkatan' => 'gardu',
            'kepanjangan' => 'Gardu',
        ]);
        Satuan::create([
            'singkatan' => 'panel',
            'kepanjangan' => 'Panel',
        ]);
    }
}

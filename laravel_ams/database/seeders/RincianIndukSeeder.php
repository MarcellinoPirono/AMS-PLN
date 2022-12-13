<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Model\RincianInduk;

class RincianIndukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
            'nama_item' => 'Pemasangan Service Wedge Clamp 1 Fasa',
            'satuan_id' => '2',
            'harga_satuan' => '8890'
        ]);
        RincianInduk::create([
            'khs_id' => '1',
            'kategori' => 'Jasa',
            'nama_item' => 'Pemasangan Tapping Seri ',
            'satuan_id' => '2',
            'harga_satuan' => '12440'
        ]);
        RincianInduk::create([
            'khs_id' => '1',
            'kategori' => 'Jasa',
            'nama_item' => 'Pemasangan pin connector di APP',
            'satuan_id' => '2',
            'harga_satuan' => '10660'
        ]);
        RincianInduk::create([
            'khs_id' => '1',
            'kategori' => 'Jasa',
            'nama_item' => 'Pemasangan APP 1 phasa',
            'satuan_id' => '3',
            'harga_satuan' => '45940'
        ]);
        RincianInduk::create([
            'khs_id' => '1',
            'kategori' => 'Jasa',
            'nama_item' => 'Penarikan kabel TIC 3 phasa',
            'satuan_id' => '1',
            'harga_satuan' => '63960'
        ]);
        RincianInduk::create([
            'khs_id' => '1',
            'kategori' => 'Jasa',
            'nama_item' => 'Pemasangan Service Wedge Clamp 3 Fasa',
            'satuan_id' => '2',
            'harga_satuan' => '8890'
        ]);
        RincianInduk::create([
            'khs_id' => '1',
            'kategori' => 'Jasa',
            'nama_item' => 'Penarikan Kabel 3 phasa',
            'satuan_id' => '2',
            'harga_satuan' => '63960'
        ]);
        RincianInduk::create([
            'khs_id' => '1',
            'kategori' => 'Jasa',
            'nama_item' => 'Pembongkaran Kabel 1 phasa',
            'satuan_id' => '2',
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
            'khs_id' => '1',
            'kategori' => 'Material',
            'nama_item' => 'Timah Segel / kg ( 12 mm )',
            'satuan_id' => '2',
            'harga_satuan' => '56816'
        ]);
        RincianInduk::create([
            'khs_id' => '1',
            'kategori' => 'Material',
            'nama_item' => 'Kabel Panjang',
            'satuan_id' => '2',
            'harga_satuan' => '56816'
        ]);
        RincianInduk::create([
            'khs_id' => '2',
            'kategori' => 'Jasa',
            'nama_item' => 'Pencabutan tiang besi',
            'satuan_id' => '2',
            'harga_satuan' => '10020'
        ]);
        RincianInduk::create([
            'khs_id' => '2',
            'kategori' => 'Jasa',
            'nama_item' => 'Pemasangan Trafo',
            'satuan_id' => '2',
            'harga_satuan' => '200122'
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
    }
}


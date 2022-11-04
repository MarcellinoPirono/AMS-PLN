<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ItemRincianInduk;
use App\Models\RincianInduk;
use App\Models\Skk;
use App\Models\Prk;
use App\Models\Rab;
use App\Models\Hpe;
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
        ItemRincianInduk::factory(6)->create();

        // ItemRincianInduk::create([
        //     'nama_kontrak' => 'Pemasangan SP 1 Fasa',
        // ]);

        // ItemRincianInduk::create([
        //     'nama_kontrak' => 'Pemasangan / penarikan SP 3 Fasa',
        // ]);

        // ItemRincianInduk::create([
        //     'nama_kontrak' => 'Pembongkaran',
        // ]);

        // ItemRincianInduk::create([
        //     'nama_kontrak' => 'Pemeliharaan',
        // ]);

        // ItemRincianInduk::create([
        //     'nama_kontrak' => 'Pekerjaan Jasa Lainnya',
        // ]);

        // ItemRincianInduk::create([
        //     'nama_kontrak' => 'Material',
        // ]);



        RincianInduk::factory(20)->create();
        Skk::factory(20)->create();
        Prk::factory(20)->create();
        Rab::factory(20)->create();
        Hpe::factory(20)->create();
    }
}

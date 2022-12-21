<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Redaksi;

class RedaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Redaksi::create([
            'nama_redaksi' => '(SPs-APP) Penerbitan PK ULP',
            'deskripsi_redaksi' => 'Rincian Pekerjaan diterbitkan dengan Perintah Kerja dari Manager Unit Layanan Pelanggan.',
            // 'sub_deskripsi' => ''
        ]);


        Redaksi::create([
            'nama_redaksi' => '(SP-APP) Syarat Bayar 95%',
            'deskripsi_redaksi' => 'Surat Perjanjian/Kontrak Rinci jenis Pengadaan Jasa/Pengadaan Jasa dan Material/Supply Erect, pembayaran dilaksanakan sebanyak 2 (dua) tahap, Pembayaran Tahap I sebesar 95% (sembilan puluh lima persen) dari nilai Surat Perjanjian/Kontrak Rinci akan dilakukan setelah semua pekerjaan 100% dilaksanakan dengan cara PIHAK KEDUA mengajukan surat permohonan pembayaran dengan melampirkan dokumen-dokumen sebagai berikut :',
            // 'sub_deskripsi' => 'a. Kwitansi bermaterai cukup;;
            // b. Surat Perjanjian/Kontrak Rinci;;
            // c. Faktur Pajak, SSP, Copy NPWP, Copy PKP, Copy surat pemberian nomor seri Faktur Pajak;;
            // d. Berita Acara Serah Terima Pekerjaan (BASTP 1) yang ditandatangani oleh Para Pihak yang dilampiri dengan Laporan Pemeriksaan Pekerjaan;;
            // e. Asli bermaterai Surat Pernyataan Keaslian Barang;;
            // f. Asli bermaterai Surat Pernyataan Jaminan Garansi dari PIHAK KEDUA;;
            // g. Copy Surat Perjanjian/Kontrak;;
            // h. Berita acara khusus apabila ada pekerjaan yang dilaksanakan diluar jam kerja;;
            // i. Bukti pembayaran iuran BPJS Ketenagakerjaan.',

        ]);
        Redaksi::create([
            'nama_redaksi' => '(SP-APP) Syarat Bayar 5%',
            'deskripsi_redaksi' => 'Pembayaran Tahap II sebesar 5% (lima persen) dari nilai Perjanjian/Kontrak akan dilakukan setelah selesainya masa pemeliharaan  berakhir yang dibuktikan dengan Berita Acara Serah Terima Pekerjaan Tahap II dan PIHAK KEDUA mengajukan Surat Permintaan pembayaran yang dilampiri dengan dokumen-dokumen sebagai berikut :',
            // 'sub_deskripsi' => 'a. Kwitansi bermaterai cukup;;
            // b. Copy Surat Perjanjian/Kontrak Rinci;;
            // c. Foto Copy Surat Perjanjian/Kontrak;;
            // d. Faktur Pajak, SSP, Copy NPWP, Copy PKP/, Copy surat pemberian nomor seri Faktur Pajak;;
            // e. Berita Acara Serah Terima Pekerjaan Tahap II (BASTP II).',
        ]);
        Redaksi::create([
            'nama_redaksi' => '(SP-APP) Realisasi atau permintaan addendum',
            'deskripsi_redaksi' => 'Realisasi pekerjaan disampaikan kepada Direksi dan Pengawas pekerjaan paling lambat 3 minggu sebelum masa SPBJ/PO berakhir. Jika kuota belum terpenuhi maka melaporkan surat permohonan Addendum dan jika jumlah realisasi kuota telah mencapai 90% maka dapat melakukan penagihan sesuai prosedur untuk dibuatkan SPBJ/PO selanjutnya.',
            // 'sub_deskripsi' => ''
        ]);
        Redaksi::create([
            'nama_redaksi' => '(JTM) Kordinasi ULP, K3 & Jadwal Padam',
            'deskripsi_redaksi' => 'Sebelum melakukan pekerjaan agar berkoordinasi dengan ULP terkait sebagai tindak lanjut monitoring jadwal padam, K3L, dan hal lain yang menjadi perhatian.',
            // 'sub_deskripsi' => ''
        ]);
        Redaksi::create([
            'nama_redaksi' => '(JTM) Syarat Bayar 95%',
            'deskripsi_redaksi' => 'Surat Perjanjian/Kontrak Rinci jenis Pengadaan Jasa/Pengadaan Jasa dan Material/Supply Erect, pembayaran dilaksanakan sebanyak 2 (dua) tahap, Pembayaran Tahap I sebesar 95% (sembilan puluh lima persen) dari nilai Surat Perjanjian/Kontrak Rinci akan dilakukan setelah semua pekerjaan 100% dilaksanakan dengan cara PIHAK KEDUA mengajukan surat permohonan pembayaran dengan melampirkan dokumen-dokumen sebagai berikut :',
            // 'sub_deskripsi' => 'a. Kwitansi bermaterai cukup;;
            // b. Surat Perjanjian/Kontrak Rinci dan Addendum (Jika ada);;
            // c. Faktur Pajak, SSP, Copy NPWP, Copy PKP, Copy surat pemberian nomor seri Faktur Pajak;;
            // d. Berita Acara Serah Terima Pekerjaan (BASTP 1) yang ditandatangani oleh Para Pihak yang dilampiri dengan Berita Acara Siap Operasi dan Kalkulasi Akhir;;
            // e. Asli bermaterai Surat Pernyataan Keaslian Barang;;
            // f. Asli bermaterai Surat Pernyataan Jaminan Garansi dari PIHAK KEDUA;,
            // g. Copy Surat Perjanjian/Kontrak;;
            // h. Berita acara khusus apabila ada pekerjaan yang dilaksanakan diluar jam kerja;;
            // i. Bukti pembayaran iuran BPJS Ketenagakerjaan;
            // j. Lampiran data titik koordinat per tiang untuk JTM dan JTR',
        ]);
        Redaksi::create([
            'nama_redaksi' => '(JTM) Syarat Bayar 5%',
            'deskripsi_redaksi' => 'Pembayaran Tahap II sebesar 5% (lima persen) dari nilai Perjanjian/Kontrak akan dilakukan setelah selesainya masa pemeliharaan  berakhir yang dibuktikan dengan Berita Acara Serah Terima Pekerjaan Tahap II dan PIHAK KEDUA mengajukan Surat Permintaan pembayaran yang dilampiri dengan dokumen-dokumen sebagai berikut :',
            // 'sub_deskripsi' => 'a. Kwitansi bermaterai cukup;,
            // b. Copy Surat Perjanjian/Kontrak Rinci dan Addendum (Jika ada);,
            // c. Foto Copy Surat Perjanjian/Kontrak;,
            // d. Faktur Pajak, SSP, Copy NPWP, Copy PKP, Copy surat pemberian nomor seri Faktur Pajak;,
            // e. Berita Acara Serah Terima Pekerjaan Tahap II (BASTP II) dan Kalkulasi Akhir.',
        ]);
    }
}

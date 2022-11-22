<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    <!-- CSS only -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> --}}

    <link href="{{ public_path('/') }}./asset/frontend/css/surat/postyle.css" rel="stylesheet" />



</head>

<body>
    <header>
        <!-- <p>header</p> -->
        <img src="{{ public_path('/') }}./asset/frontend/images/header_pln.svg" alt="">
        <!-- <div class="header">
        </div> -->
    </header>

    <main>

        @foreach ($po_khs as $pokhs)
            <div class="contents">
                <table style="width:100%;" border="1px solid black" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="width:38%">Nomor: {{ $pokhs->nomor_po }}</td>
                        <td style="width:20%"></td>
                        <td colspan="2">{{ \Carbon\Carbon::parse($pokhs->tanggal_po)->isoFormat('dddd, DD MMMM YYYY') }}</td>
                    </tr>
                    <tr>
                        <td>Lamp.: 1(satu) Set</td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td>Perihal: Surat Pesanan Barang / Jasa (SPBJ)</td>
                        <td></td>
                        <td colspan="2">Kepada :</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2">{{ $pokhs->nomor_kontraks->vendors->nama_vendor }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="width:10%">Alamat : </td>
                        <td class="coba">{{ $pokhs->nomor_kontraks->vendors->alamat_kantor_1 }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2">di- Tempat</td>
                    </tr>
                </table>



                <p class="p2">{{ \Carbon\Carbon::parse($pokhs->tanggal_po)->isoFormat('dddd, DD MMMM YYYY') }}
                    <br><br> Kepada: {{ $pokhs->nomor_kontraks->vendors->nama_vendor }}<br> Alamat:
                    {{ $pokhs->nomor_kontraks->vendors->alamat_kantor_1 }} <br> di- Tempat
                </p>
                <p class="p1">Nomor: {{ $pokhs->nomor_po }} <br> Lamp.: 1(satu) Set <br> Perihal: Surat Pesanan
                    Barang / Jasa (SPBJ)</p>
                <div class="content1">
                    <p>Menunjuk Kontrak Perjanjian Sebagai Berikut</p>
                    <p>Kontrak Nomor : {{ $pokhs->nomor_kontraks->nomor_kontrak_induk }}</p>
                    <p>Tanggal :
                        {{ \Carbon\Carbon::parse($pokhs->nomor_kontraks->tanggal_kontrak_induk)->isoFormat('DD MMMM YYYY') }}
                    </p>
                    <p>Pekerjaan : {{ $pokhs->nomor_kontraks->khs->nama_pekerjaan }}</p>
                </div>
                <div class="content2">
                    <p>Maka dengan ini disampaikan kepada saudara untuk melaksanakan pekerjaan : </p>
                    <p><b>{{ $pokhs->pekerjaan }}</b></p>
                    <p>Lokasi : {{ $pokhs->lokasi }}</p>
                </div>
                <div class="content3">
                    <ol type="1">
                        <li>Harga Borongan Pekerjaan {{ $pokhs->total_harga }}</li>
                        <li>Rincian Pekerjaan diterbitkan dengan Perintah Kerja dari Manager Unit Layanan Pelanggan</li>
                        <li>Jangka waktu pelaksanaan pekerjaan hari kalender sejak tanggal {{ $pokhs->startDate }}
                            sampai
                            dengan tanggal {{ $pokhs->endDate }}</li>
                        <li>Sumber Dana Sesuai dengan SKK {{ $pokhs->skks->nomor_skk }} <br> PRK No:
                            {{ $pokhs->prks->no_prk }}</li>
                        <li>Direksi Pekerjaan adalah {{ $pokhs->pejabats->nama_pejabat }} PT PLN (Persero) UP3 Makassar
                            Selatan</li>
                        <li>Pengawas Pekerjaan adalah {{ $pokhs->pengawas }} PT PLN (Persero) UP3 Makassar Selatan</li>
                        <li>Tempat Penyerahan pekerjaan di Kantor PT PLN (Persero) UP3 Makassar Selatan Jl. Hertasning
                            No.99
                            Rappocini - Makassar dilengkapi dengan realisasi perintah kerja yang sudah selesai
                            dilaksanakan
                        </li>
                        <li>Surat Perjanjian/Kontrak Rinci jenis Pengadaan Jasa/Pengadaan Jasa dan Material/Supply
                            Erect,
                            pembayaran dilaksanakan sebanyak 2 (dua) tahap, Pembayaran Tahap I sebesar 95% (sembilan
                            puluh
                            lima persen) dari nilai Surat Perjanjian/Kontrak Rinci akan dilakukan setelah semua
                            pekerjaan
                            100%dilaksanakan dengan cara PIHAK KEDUA mengajukan surat permohonan pembayaran dengan
                            melampirkan dokumen-dokumen sebagai berikut:
                            <ol type="a">
                                <li>Kwitansi bermaterai Cukup;</li>
                                <li>Surat Perjanjian/Kontrak Rinci;</li>
                                <li>Faktur Pajak, SSP, Copy NPWP, Copy PKP, Copy surat pemberian nomor seri Faktur Pajak
                                </li>
                                <li>Berita Acara Serah Terima Pekerjaan (BASTP 1) yang ditandatangani oleh Para Pihak
                                    yang
                                    dilampiri dengan Laporan Pemeriksaan Pekerjaan;</li>
                                <li>Asli bermaterai Surat Pernyataan Keaslian Barang;</li>
                                <li>Asli bermaterai Surat Pernyataan Jaminan Garansi dari PIHAK KEDUA;</li>
                                <li>Copy Surat Perjanjian/Kontrak;</li>
                                <li>Berita acara khusus apabila ada pekerjaan yang dilaksanakan diluar jam kerja;</li>
                                <li>Bukti pembayaran iuran BPJS Ketenagakerjaan.</li>
                                <li>Kwitansi bermaterai Cukup;</li>
                                <li>Surat Perjanjian/Kontrak Rinci;</li>
                                <li>Faktur Pajak, SSP, Copy NPWP, Copy PKP, Copy surat pemberian nomor seri Faktur Pajak
                                </li>
                                <li>Berita Acara Serah Terima Pekerjaan (BASTP 1) yang ditandatangani oleh Para Pihak
                                    yang
                                    dilampiri dengan Laporan Pemeriksaan Pekerjaan;</li>
                                <li>Asli bermaterai Surat Pernyataan Keaslian Barang;</li>
                                <li>Asli bermaterai Surat Pernyataan Jaminan Garansi dari PIHAK KEDUA;</li>
                                <li>Copy Surat Perjanjian/Kontrak;</li>
                                <li>Berita acara khusus apabila ada pekerjaan yang dilaksanakan diluar jam kerja;</li>
                                <li>Bukti pembayaran iuran BPJS Ketenagakerjaan.</li>
                                <li>Kwitansi bermaterai Cukup;</li>
                                <li>Surat Perjanjian/Kontrak Rinci;</li>
                                <li>Faktur Pajak, SSP, Copy NPWP, Copy PKP, Copy surat pemberian nomor seri Faktur Pajak
                                </li>
                                <li>Berita Acara Serah Terima Pekerjaan (BASTP 1) yang ditandatangani oleh Para Pihak
                                    yang
                                    dilampiri dengan Laporan Pemeriksaan Pekerjaan;</li>
                                <li>Asli bermaterai Surat Pernyataan Keaslian Barang;</li>
                                <li>Asli bermaterai Surat Pernyataan Jaminan Garansi dari PIHAK KEDUA;</li>
                                <li>Copy Surat Perjanjian/Kontrak;</li>
                                <li>Berita acara khusus apabila ada pekerjaan yang dilaksanakan diluar jam kerja;</li>
                                <li>Bukti pembayaran iuran BPJS Ketenagakerjaan.</li>
                            </ol>
                        </li>
                    </ol>
                </div>
            </div>
        @endforeach
    </main>
    <footer>
        <div class="footer-container">
            <div class="footer-1">
                <p>Jl. Jend. Sudirman No.99 Tamalate, Kec.Rappocini, Kota Makassar Telp 0411 886245 - 882707W
                <link style="color: blue"><u>www.pln.co.id</u>
                <link></p>
                <p>Paraf________</p>
            </div>            
        </div>
        
    </footer>


    <div class="page-break"></div>
    <div class="navbar">
        <h1><u>RINCIAN ANGGARAN BIAYA</u></h1>
    </div>
    @foreach ($po_khs as $pokhs)
        <div class="sub-judul">
            <p>PEKERJAAN <span class="tabulasi"></span>: {{ $pokhs->pekerjaan }}</p>
            <p>LOKASI<span class="tabulasi"></span>: {{ $pokhs->lokasi }}</p>
            <p>SUMBER DANA Dana<span class="tabulasi"></span>: {{ $pokhs->skks->nomor_skk }}</p>
            <p>NOMOR PRK        <span class="tabulasi"></span>: {{ $pokhs->prks->no_prk }}</p>

        </div>
    @endforeach
    <div id="firstTable">
        <table width="100%" border="2" cellspacing="0" cellpadding="0">
            <tr class="warna">
                <td rowspan="2" align="center" valign="middle">No</td>
                <td rowspan="2" align="center" valign="middle">Uraian Pekerjaan</td>
                <td rowspan="2" align="center" valign="middle">Satuan</td>
                <td rowspan="2" align="center" valign="middle">Volume</td>
                <td colspan="2" align="center" valign="middle">Harga</td>
            </tr>
            <tr class="warna">
                <td align="center" valign="middle">Satuan (RP)</td>
                <td align="center" valign="middle">Jumlah (RP)</td>
            </tr>
            <!-- <tr>
        <td align="center" valign="top"></td>
        <td align="center" valign="top"></td>
        <td align="center" valign="top"></td>
        <td align="center" valign="top"></td>
        <td align="center" valign="top"></td>
        <td align="center" valign="top"></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr> -->
            @foreach ($rab_khs as $rabkhs)
                <tr>
                    <td class="first">{{ $loop->iteration }}</td>
                    <td class="first">{{ $rabkhs->rincian_induks->nama_item }}</td>
                    <td class="first">{{ $rabkhs->satuans->singkatan }}</td>
                    <td class="first">{{ $rabkhs->volume }}</td>
                    <td class="first">@currency2($rabkhs->harga_satuan)</td>
                    <td class="first">@currency2($rabkhs->jumlah_harga)</td>
                </tr>
            @endforeach
        </table>
    </div>




</body>

</html>

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

    <footer>
        <div class="footer-2">
            Paraf________________
        </div>
        <div class="footer-1">
            Jl. Jend. Sudirman No.99 Tamalate, Kec.Rappocini, Kota Makassar Telp 0411 886245 - 882707W
            <link style="color: blue"><u style="color: blue">www.pln.co.id</u>
            <link>
        </div>
        <!-- <div class="footer-container">
        </div> -->

    </footer>

    <main>

        @foreach ($po_khs as $pokhs)
            <div class="contents">
                <table class="uprightTbl noborder" style="width:100%;" id="rincian" cellspacing="0" cellpadding="0">
                    <tr class="noborder">
                        <td style="width:6%;">Nomor
                        </td>
                        <td style="width:54%">: {{ $pokhs->nomor_po }}</td>
                        <td colspan="2">
                            {{ \Carbon\Carbon::parse($pokhs->tanggal_po)->isoFormat('dddd, DD MMMM YYYY') }}</td>
                    </tr>
                    <tr class="noborder">
                        <td>Lamp.</td>
                        <td>: 1(satu) Set</td>
                        <td colspan="2"></td>
                    </tr>
                    <tr class="noborder">
                        <td>Perihal</td>
                        <td>: Surat Pesanan Barang / Jasa (SPBJ)</td>
                        <td colspan="2">Kepada :</td>
                    </tr>
                    <tr class="noborder">
                        <td></td>
                        <td></td>
                        <td colspan="2">{{ $pokhs->nomor_kontraks->vendors->nama_vendor }}</td>
                    </tr>
                    <tr class="noborder">
                        <td></td>
                        <td></td>
                        <td style="width:7%" valign="top">Alamat : </td>
                        <td class="coba">{{ $pokhs->nomor_kontraks->vendors->alamat_kantor_1 }}</td>
                    </tr>
                    <tr class="noborder">
                        <td></td>
                        <td></td>
                        <td>di-</td>
                        <td>Tempat
                    </tr>
                </table>
            </div>
            <div style="margin-top: 20px">
                <table width="90%" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="3" style="text-indent:60px; ">Menunjuk Kontrak Perjanjian Sebagai
                            Berikut</td>
                    </tr>
                    <tr>
                        <td width="23%" style="text-indent:60px;" valign="top">Kontrak Nomor</td>
                        <td width="2%" valign="top">:</td>
                        <td width="65%" valign="top">{{ $pokhs->nomor_kontraks->nomor_kontrak_induk }}</td>
                    </tr>
                    <tr>
                        <td style="text-indent:60px;">Tanggal
                        </td>
                        <td>:</td>
                        <td>{{ \Carbon\Carbon::parse($pokhs->nomor_kontraks->tanggal_kontrak_induk)->isoFormat('DD MMMM YYYY') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="text-indent:60px;">Pekerjan</td>
                        <td valign="top">:</td>
                        <td>{{ $pokhs->nomor_kontraks->khs->nama_pekerjaan }}</td>
                    </tr>
                    <tr>
                        <td style="text-indent:60px;padding-top:20px" colspan="3">Maka dengan ini disampaikan kepada saudara untuk
                            melaksanakan pekerjaan :</td>
                    </tr>
                    <tr>
                        <td style="text-indent:80px; font-weight:bold;" colspan="3">{{ $pokhs->pekerjaan }}</td>
                    </tr>
                    <tr>
                        <td style="text-indent:80px;font-weight:bold;">Lokasi</td>
                        <td>:</td>
                        <td style="font-weight:bold;">{{ $pokhs->lokasi }}</td>
                    </tr>
                </table>
            </div>
            <div class="content3" style="margin-left: 40px;">
                <ol type="1">
                    <li>Harga Borongan Pekerjaan @currency($pokhs->total_harga),- (Termasuk PPN 11%)</li>
                    <li>Rincian Pekerjaan diterbitkan dengan Perintah Kerja dari Manager Unit Layanan Pelanggan
                    </li>
                    <li>Jangka waktu pelaksanaan pekerjaan {{ $days }} <span class="italic">({{Terbilang::make($days)}})</span> hari kalender sejak tanggal {{  \Carbon\Carbon::parse($pokhs->startdate)->isoFormat('DD MMMM YYYY') }}
                        sampai
                        dengan tanggal {{  \Carbon\Carbon::parse($pokhs->enddate)->isoFormat('DD MMMM YYYY') }}</li>
                    <li>Sumber Dana Sesuai dengan SKK {{ $pokhs->skks->nomor_skk }} <br> PRK No:
                        {{ $pokhs->prks->no_prk }}</li>
                    <li>Direksi Pekerjaan adalah {{ $pokhs->pejabats->jabatan }} PT PLN (Persero) UP3
                        Makassar
                        Selatan</li>
                    <li>Pengawas Pekerjaan adalah {{ $pokhs->pengawas }} PT PLN (Persero) UP3 Makassar Selatan
                    </li>
                    <li>Tempat Penyerahan pekerjaan di Kantor PT PLN (Persero) UP3 Makassar Selatan Jl.
                        Hertasning
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
                            <li>Faktur Pajak, SSP, Copy NPWP, Copy PKP, Copy surat pemberian nomor seri Faktur
                                Pajak
                            </li>
                            <li>Berita Acara Serah Terima Pekerjaan (BASTP 1) yang ditandatangani oleh Para
                                Pihak
                                yang
                                dilampiri dengan Laporan Pemeriksaan Pekerjaan;</li>
                            <li>Asli bermaterai Surat Pernyataan Keaslian Barang;</li>
                            <li>Asli bermaterai Surat Pernyataan Jaminan Garansi dari PIHAK KEDUA;</li>
                            <li>Copy Surat Perjanjian/Kontrak;</li>
                            <li>Berita acara khusus apabila ada pekerjaan yang dilaksanakan diluar jam kerja;
                            </li>
                            <li>Bukti pembayaran iuran BPJS Ketenagakerjaan.</li>
                            <li>Kwitansi bermaterai Cukup;</li>
                            <li>Surat Perjanjian/Kontrak Rinci;</li>
                            <li>Faktur Pajak, SSP, Copy NPWP, Copy PKP, Copy surat pemberian nomor seri Faktur
                                Pajak
                            </li>
                            <li>Berita Acara Serah Terima Pekerjaan (BASTP 1) yang ditandatangani oleh Para
                                Pihak
                                yang
                                dilampiri dengan Laporan Pemeriksaan Pekerjaan;</li>
                            <li>Asli bermaterai Surat Pernyataan Keaslian Barang;</li>
                            <li>Asli bermaterai Surat Pernyataan Jaminan Garansi dari PIHAK KEDUA;</li>
                            <li>Copy Surat Perjanjian/Kontrak;</li>
                            <li>Berita acara khusus apabila ada pekerjaan yang dilaksanakan diluar jam kerja;
                            </li>
                            <li>Bukti pembayaran iuran BPJS Ketenagakerjaan.</li>
                            <li>Kwitansi bermaterai Cukup;</li>
                            <li>Surat Perjanjian/Kontrak Rinci;</li>
                            <li>Faktur Pajak, SSP, Copy NPWP, Copy PKP, Copy surat pemberian nomor seri Faktur
                                Pajak
                            </li>
                            <li>Berita Acara Serah Terima Pekerjaan (BASTP 1) yang ditandatangani oleh Para
                                Pihak
                                yang
                                dilampiri dengan Laporan Pemeriksaan Pekerjaan;</li>
                            <li>Asli bermaterai Surat Pernyataan Keaslian Barang;</li>
                            <li>Asli bermaterai Surat Pernyataan Jaminan Garansi dari PIHAK KEDUA;</li>
                            <li>Copy Surat Perjanjian/Kontrak;</li>
                            <li>Berita acara khusus apabila ada pekerjaan yang dilaksanakan diluar jam kerja;
                            </li>
                            <li>Bukti pembayaran iuran BPJS Ketenagakerjaan.</li>
                        </ol>
                    </li>
                </ol>
            </div>
            </div>
        @endforeach

        <div class="page-break"></div>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td style="height: 50px;" align="center" valign="bottom">SETUJU MELAKSANAKAN</td>
                <td style="width:35%;" align="center" valign="bottom">PT PLN (PERSERO) UIW SULSELRABAR</td>
            </tr>
            <tr>
                <td align="center" valign="top">{{$pokhs->nomor_kontraks->vendors->nama_vendor}}</td>
                <td align="center" valign="middle">UP3 MAKASSAR SELATAN</td>
            </tr>
            <tr>
                <td align="center" valign="top">Direktur</td>
                <td align="center" valign="middle">{{$jabatan_manager}}</td>
            </tr>
            <tr style="height: 150px;">
                <td style="height: 150px;" align="center" valign="bottom">{{$pokhs->nomor_kontraks->vendors->nama_direktur}}</td>
                <td align="center" valign="bottom">{{$nama_manager}}</td>
            </tr>
        </table>

    </main>



    <div class="page-break"></div>

  
    
    @foreach ($po_khs as $pokhs)
    <table class="sub-judul" width="100%">
        <tr>
            <td colspan="3" class="judul">RINCIAN ANGGARAN BIAYA</td>
        </tr>
        <tr>
            <td width="18%">PEKERJAAN</td>
            <td width="2%">:</td>
            <td width="80%">{{ $pokhs->pekerjaan }}</td>
        </tr>
         <tr>
            <td>LOKASI</td>
            <td>:</td>
            <td>{{ $pokhs->lokasi }}</td>
        </tr>
        <tr>
            <td>SUMBER DANA</td>
            <td>:</td>
            <td>{{ $pokhs->skks->nomor_skk }}</td>
        </tr>
        <tr>
            <td>NOMOR PRK</td>
            <td>:</td>
            <td>{{ $pokhs->prks->no_prk }}</td>
        </tr>
    </table>
        
    @endforeach
    <div class="wrapword" id="firstTable">
        <table width="100%" border="2" cellspacing="0" cellpadding="0">
            <tr class="warna">
                <td style="width:4%;" rowspan="2" align="center" valign="middle">No</td>
                <td rowspan="2" align="center" valign="middle">Uraian Pekerjaan</td>
                <td style="width:9%;" rowspan="2" align="center" valign="middle">Satuan</td>
                <td style="width:9%;" rowspan="2" align="center" valign="middle">Volume</td>
                <td style="width:25%;" colspan="2" align="center" valign="middle">Harga</td>
            </tr>
            <tr class="warna">
                <td style="width:12%;" align="center" valign="middle">Satuan (RP)</td>
                <td style="width:15%;" align="center" valign="middle">Jumlah (RP)</td>
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
                @if ($rabkhs->kategori_order == "Jasa")
                <tr>
                    
                </tr>
                <tr>
                   <td class="first" align="center" valign="middle">{{ $loop->iteration }}</td>                    
                   <!-- <td class="first" align="center" valign="middle">{{ $loop->iteration }}</td> -->
                   <td class="first" align="left" valign="middle">{{ $rabkhs->rincian_induks->nama_item }}</td>
                   <td class="first" align="center" valign="middle">{{ $rabkhs->satuan_id }}</td>
                   <td class="first" align="center" valign="middle">{{ $rabkhs->volume }}</td>
                   <td class="first" align="right" valign="middle">@currency2($rabkhs->harga_satuan)</td>
                   <td class="first" align="right" valign="middle">@currency2($rabkhs->jumlah_harga)</td>
               </tr>                    
                @endif
                @if ($rabkhs->kategori_order == "Material")
                <tr>
                   <td class="first" align="center" valign="middle">{{ $loop->iteration }}</td>                    
                   <!-- <td class="first" align="center" valign="middle">{{ $loop->iteration }}</td> -->
                   <td class="first" align="left" valign="middle">{{ $rabkhs->rincian_induks->nama_item }}</td>
                   <td class="first" align="center" valign="middle">{{ $rabkhs->satuans->singkatan }}</td>
                   <td class="first" align="center" valign="middle">{{ $rabkhs->volume }}</td>
                   <td class="first" align="right" valign="middle">@currency2($rabkhs->harga_satuan)</td>
                   <td class="first" align="right" valign="middle">@currency2($rabkhs->jumlah_harga)</td>
               </tr>  
                @endif
                @endforeach
            <tr>
                <td rowspan="3" colspan="3"></td>
                <td colspan="2" align="center" valign="middle"><b>Jumlah</b></td>
                <td align="right"><b>@currency2($jumlah)</b></td>
            </tr>
            <tr>
                <td colspan="2" align="center" valign="middle"><b>PPN 11%</b></td>
                <td align="right"><b>@currency2($ppn)</b></td>
            </tr>
            @foreach ($po_khs as $pokhs)
            <tr>
                <td colspan="2" align="center" valign="middle"><b>TOTAL</b></td>
                <td align="right"><b>@currency2($pokhs->total_harga)</b></td>
            </tr>                
            <tr>
                <td class="first1"></td>
                <td class="first2" rowspan="2" colspan="5" style="font-weight: bold; font-style:italic;">Terbilang: {{Terbilang::make($pokhs->total_harga, ' rupiah', 'Senilai ')}}</td>
            </tr>
            <tr>
                <td class="first1"></td>
            </tr>
            @endforeach
        </table>
    </div>

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td style="height: 50px;" align="center" valign="bottom">Mengetahui</td>
        <td style="width:35%;" align="center" valign="bottom">Makassar, {{ \Carbon\Carbon::parse($pokhs->tanggal_po)->isoFormat('dddd, DD MMMM YYYY') }}</td>
    </tr>
    <tr>{{  }}
        <td align="center" valign="top">{{$jabatan_manager}}</td>
        <td align="center" valign="middle">{{$pokhs->pejabats->jabatan}}</td>
    </tr>
    <tr style="height: 150px;">
        <td style="height: 150px;" align="center" valign="bottom">{{$nama_manager}}</td>
        <td align="center" valign="bottom">{{$pokhs->pejabats->nama_pejabat}}</td>
    </tr>
    </table>



</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    <link href="{{ public_path('/') }}./asset/frontend/css/surat/postyle.css" rel="stylesheet" />

</head>

<body>
    <header class="mt-1">
        <img class="mt-1" src="{{ public_path('/') }}./asset/frontend/images/header_pln.svg" alt="">
    </header>

    <footer>
        <div class="footer-2">
            Paraf________________
        </div>
        <div class="footer-1">
            Jl. Jend. Hertasning No.99 Tamalate, Kec.Rappocini, Kota Makassar Telp 0411 886245 - 882707W
            <link style="color: blue"><u style="color: blue">www.pln.co.id</u>
            <link>
        </div>
    </footer>

    <main>

        @foreach ($po_khs as $pokhs)
            <div class="contents">
                <table class="uprightTbl noborder ml-2" style="width:95%;" id="rincian" cellspacing="0"
                    cellpadding="0" align="center">
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
                        <td style="text-indent:60px;padding-top:20px" colspan="3">Maka dengan ini disampaikan kepada
                            saudara untuk
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
            <div class="content3" style="margin-left: 40px; margin-right: -20px;">
                <ol type="1" style="justify-content: space-between">
                    <li>Harga Borongan Pekerjaan <b>@currency($pokhs->total_harga),-</b> (Termasuk PPN 11%)</li>
                    <li>Rincian Pekerjaan diterbitkan dengan Perintah Kerja dari Manager Unit Layanan Pelanggan
                    </li>
                    <li>Jangka waktu pelaksanaan pekerjaan <b>{{ $days }}</b> <span
                            class="italic">({{ Terbilang::make($days) }})</span> hari kalender sejak tanggal
                        <b>{{ \Carbon\Carbon::parse($pokhs->startdate)->isoFormat('DD MMMM YYYY') }}</b>
                        sampai
                        dengan tanggal <b>{{ \Carbon\Carbon::parse($pokhs->enddate)->isoFormat('DD MMMM YYYY') }}</b>
                    </li>
                    <li>Sumber Dana Sesuai dengan SKK <b>{{ $pokhs->skks->nomor_skk }} <br> PRK No:
                            {{ $pokhs->prks->no_prk }}</b></li>
                    <li>Direksi Pekerjaan adalah <b>{{ $pokhs->pejabats->jabatan }} PT PLN (Persero) UP3
                            Makassar
                            Selatan</b></li>
                    <li>Pengawas Pekerjaan adalah <b>{{ $pokhs->pengawas }}</b> PT PLN (Persero) UP3 Makassar Selatan
                    </li>
                    <li>Tempat Penyerahan pekerjaan di Kantor PT PLN (Persero) UP3 Makassar Selatan Jl.
                        Hertasning
                        No.99
                        Rappocini - Makassar dilengkapi dengan realisasi perintah kerja yang sudah selesai
                        dilaksanakan.
                    </li>
                    @foreach ($redaksis as $redaksi)
                        <li>
                            {{ $redaksi->redaksi->deskripsi_redaksi }}
                            @if ($redaksi->sub_deskripsi_id != '')
                                @foreach (explode(';', $redaksi->sub_deskripsi_id) as $poin)
                                    <ul type="none" style="list-style-position: inside; padding-left: 0;">

                                        <li>{{ $poin }}</li>
                                    </ul>
                                @endforeach
                            @endif
                        </li>
                    @endforeach



                </ol>

                <p>
                    Apabila SPBJ/PO ini saudara(i) setuju dan sanggup melaksanakan, harap menandatangani SPBJ/PO ini
                    dan dikembalikan kepada kami untuk proses lebih lanjut.
                    <br>
                    SPBJ/PO ini dibuat dalam 3 (tiga) rangkap, asli dan 1 (satu) turunannya dibubuhi materai
                    secukupnya dan mempunyai kekuatan hukum yang sama.
                </p>

                <p>Demikian SPBJ/PO ini dibuat untuk dilaksanakan dan dapat diselesaikan dengan sebaik-baiknya.</p>

            </div>
            </div>
            <table width="90%" border="0" cellspacing="0" cellpadding="0" align="left">
                <tr>
                    <td style="height: 50px;" align="center" valign="bottom">SETUJU MELAKSANAKAN</td>
                    <td style="width:45%;" align="center" valign="bottom">PT PLN (PERSERO) UIW SULSELRABAR</td>
                </tr>
                <tr>
                    <td align="center" valign="top">{{ $pokhs->nomor_kontraks->vendors->nama_vendor }}</td>
                    <td align="center" valign="middle">UP3 MAKASSAR SELATAN</td>
                </tr>
                <tr>
                    <td align="center" valign="top">Direktur</td>
                    <td align="center" valign="middle">{{ $jabatan_manager }}</td>
                </tr>
                <tr style="height: 120px;">
                    <td style="height: 120px;" align="center" valign="bottom">
                        {{ $pokhs->nomor_kontraks->vendors->nama_direktur }}</td>
                    <td align="center" valign="bottom">{{ $nama_manager }}</td>
                </tr>
            </table>
        @endforeach


        {{-- <div class="page-break"></div> --}}


    </main>

    <div class="page-break"></div>

    @foreach ($po_khs as $pokhs)
        <table class="sub-judul" width="95%" cellspacing="0" cellpadding="0" align="center">
            <tr>
                <td colspan="3" class="judul">RINCIAN ANGGARAN BIAYA</td>
            </tr>
            <tr>
                <td width="18%" style="height: 4px;">PEKERJAAN</td>
                <td width="2%" style="height: 4px;">:</td>
                <td width="80%" style="height: 4px;">{{ $pokhs->pekerjaan }}</td>
            </tr>
            <tr>
                <td>LOKASI</td>
                <td>:</td>
                {{-- <td>{{ $pokhs->lokasi }}</td> --}}
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
        <table width="95%" border="2" cellspacing="0" cellpadding="0" align="center">
            <tr class="warna">
                <td style="width:4%;" rowspan="2" align="center" valign="middle">No</td>
                <td rowspan="2" align="center" valign="middle">Uraian Pekerjaan</td>
                <td style="width:12%;" rowspan="2" align="center" valign="middle">Satuan</td>
                <td style="width:9%;" rowspan="2" align="center" valign="middle">Volume</td>
                <td style="width:25%;" colspan="2" align="center" valign="middle">Harga</td>
            </tr>
            <tr class="warna">
                <td style="width:12%;" align="center" valign="middle">Satuan (RP)</td>
                <td style="width:12%;" align="center" valign="middle">Jumlah (RP)</td>
            </tr>
            <tr id="tr_jasa">
                <td class="first" align="center" valign="middle"></td>
                <td class="first tabellkiri" style="font-weight: bold" align="left" valign="middle">JASA:</td>
                <td class="first" align="center" valign="middle"></td>
                <td class="first" align="center" valign="middle"></td>
                <td class="first tabellkanan" align="right" valign="middle"></td>
                <td class="first tabellkanan" align="right" valign="middle"></td>
            </tr>
            @if (count($kategori_jasa) > 0)
                @foreach ($kategori_jasa as $jasa)
                    <tr>
                        <td class="first" align="center" valign="middle">{{ $loop->iteration }}</td>
                        <td class="first tabellkiri" align="left" valign="middle">
                            {{ $jasa->rincian_induks->nama_item }}
                        </td>
                        <td class="first" align="center" valign="middle">{{ $jasa->satuans->singkatan }}</td>
                        <td class="first" align="center" valign="middle">{{ $jasa->volume }}</td>
                        <td class="first tabellkanan" align="right" valign="middle">@currency2($jasa->harga_satuan)</td>
                        <td class="first tabellkanan" align="right" valign="middle">@currency2($jasa->jumlah_harga)</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="first" align="center" valign="middle"></td>
                    <td class="first tabellkiri" style="font-style: italic" align="left" valign="middle">Kategori
                        Jasa Tidak
                        Ada</td>
                    <td class="first" align="center" valign="middle"></td>
                    <td class="first" align="center" valign="middle"></td>
                    <td class="first tabellkanan" align="right" valign="middle"></td>
                    <td class="first tabellkanan" align="right" valign="middle"></td>
                </tr>
            @endif
            <tr id="tr_material">
                <td class="first" align="center" valign="middle"></td>
                <td class="first tabellkiri" style="font-weight: bold" align="left" valign="middle"><br>MATERIAL:
                </td>
                <td class="first" align="center" valign="middle"></td>
                <td class="first" align="center" valign="middle"></td>
                <td class="first tabellkanan" align="right" valign="middle"></td>
                <td class="first tabellkanan" align="right" valign="middle"></td>
            </tr>
            @if (count($kategori_material) > 0)
                @foreach ($kategori_material as $material)
                    <tr>
                        <td class="first" align="center" valign="middle">{{ $loop->iteration }}</td>
                        <td class="first tabellkiri" align="left" valign="middle">
                            {{ $material->rincian_induks->nama_item }}
                        </td>
                        <td class="first" align="center" valign="middle">{{ $material->satuans->singkatan }}</td>
                        <td class="first" align="center" valign="middle">{{ $material->volume }}</td>
                        <td class="first tabellkanan" align="right" valign="middle">@currency2($material->harga_satuan)</td>
                        <td class="first tabellkanan" align="right" valign="middle">@currency2($material->jumlah_harga)</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="first" align="center" valign="middle"></td>
                    <td class="first tabellkiri" style="font-style: italic" align="left" valign="middle">Kategori
                        Material
                        Tidak Ada</td>
                    <td class="first" align="center" valign="middle"></td>
                    <td class="first" align="center" valign="middle"></td>
                    <td class="first tabellkanan" align="right" valign="middle"></td>
                    <td class="first tabellkanan" align="right" valign="middle"></td>
                </tr>
            @endif
            {{-- @foreach ($rab_khs as $rabkhs)
                @if ($rabkhs->kategori_order == 'Jasa')
                <tr>
                   <td class="first" align="center" valign="middle">{{ $loop->iteration }}</td>
                   <td class="first tabellkiri" align="left" valign="middle">{{ $rabkhs->rincian_induks->nama_item }}</td>
                   <td class="first" align="center" valign="middle">{{ $rabkhs->satuans->singkatan }}</td>
                   <td class="first" align="center" valign="middle">{{ $rabkhs->volume }}</td>
                   <td class="first tabellkanan" align="right" valign="middle">@currency2($rabkhs->harga_satuan)</td>
                   <td class="first tabellkanan" align="right" valign="middle">@currency2($rabkhs->jumlah_harga)</td>
               </tr>
                @endif
                @if ($rabkhs->kategori_order == 'Material')
                <tr>
                   <td class="first" align="center" valign="middle">{{ $loop->iteration }}</td>
                   <td class="first tabellkiri" align="left" valign="middle">{{ $rabkhs->rincian_induks->nama_item }}</td>
                   <td class="first" align="center" valign="middle">{{ $rabkhs->satuans->singkatan }}</td>
                   <td class="first" align="center" valign="middle">{{ $rabkhs->volume }}</td>
                   <td class="first tabellkanan" align="right" valign="middle">@currency2($rabkhs->harga_satuan)</td>
                   <td class="first tabellkanan" align="right" valign="middle">@currency2($rabkhs->jumlah_harga)</td>
               </tr>
                @endif
                @endforeach --}}
            <tr>
                <td rowspan="3" colspan="3"></td>
                <td colspan="2" align="center" valign="middle"><b>Jumlah</b></td>
                <td class="tabellkanan" align="right"><b>@currency2($jumlah)</b></td>
            </tr>
            <tr>
                <td colspan="2" align="center" valign="middle"><b>PPN 11%</b></td>
                <td class="tabellkanan" align="right"><b>@currency2($ppn)</b></td>
            </tr>
            @foreach ($po_khs as $pokhs)
                <tr>
                    <td colspan="2" align="center" valign="middle"><b>TOTAL</b></td>
                    <td class="tabellkanan" align="right"><b>@currency2($pokhs->total_harga)</b></td>
                </tr>
                <tr>
                    <td class="first1"></td>
                    <td class="first2" rowspan="2" colspan="5" style="font-weight: bold; font-style:italic;">
                        Terbilang: {{ Terbilang::make($pokhs->total_harga, ' rupiah') }}</td>
                </tr>
                <tr>
                    <td class="first1"></td>
                </tr>
            @endforeach
        </table>
    </div>

    <table class="wrapword" width="95%" border="0   " cellspacing="0" cellpadding="0" align="center">
        <tr>
            <td style="height: 50px;" align="center" valign="bottom">Mengetahui</td>
            <td style="width:36%;" align="center" valign="bottom">Makassar,
                {{ \Carbon\Carbon::parse($pokhs->tanggal_po)->isoFormat('dddd, DD MMMM YYYY') }}</td>
        </tr>
        <tr>
            <td align="center" valign="top">{{ $jabatan_manager }}</td>
            <td align="center" valign="middle">{{ $pokhs->pejabats->jabatan }}</td>
        </tr>
        <tr style="height: 85px;">
            <td style="height: 85px;" align="center" valign="bottom">{{ $nama_manager }}</td>
            <td align="center" valign="bottom">{{ $pokhs->pejabats->nama_pejabat }}</td>
        </tr>
    </table>
</body>

</html>

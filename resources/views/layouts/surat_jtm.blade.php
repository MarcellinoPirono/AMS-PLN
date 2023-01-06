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
                <table class="uprightTbl noborder ml-2" style="width:92%;" id="rincian" cellspacing="0"
                    cellpadding="0" align="center">
                    <tr class="noborder">
                        <td style="width:6%;">Nomor
                        </td>
                        <td style="width:54%">: {{ $pokhs->nomor_po }}</td>
                        <td colspan="2">
                            {{ \Carbon\Carbon::parse($pokhs->startdate)->isoFormat('dddd, DD MMMM YYYY') }}</td>
                    </tr>
                    <tr class="noborder">
                        <td>Lamp.</td>
                        <td>: 1(satu) Set</td>
                        <td colspan="2"></td>
                    </tr>
                    <tr class="noborder">
                        <td>Sifat</td>
                        <td>: Biasa</td>
                        <td colspan="2">Kepada :</td>
                    </tr>
                    <tr class="noborder">
                        <td>Perihal</td>
                        <td>: Surat Pesanan Barang / Jasa (SPBJ)</td>
                        <td colspan="2">{{ $pokhs->nomor_kontraks->vendors->nama_vendor }}</td>
                    </tr>
                    <tr class="noborder">
                        <td></td>
                        <td></td>
                        <td class="coba" colspan="2">{{ $pokhs->nomor_kontraks->vendors->alamat_kantor_1 }}</td>
                    </tr>
                    <tr class="noborder">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
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
                        <td valign="top" style="text-indent:60px;">Pekerjaan</td>
                        <td valign="top">:</td>
                        <td>{{ $pokhs->nomor_kontraks->khs->nama_pekerjaan }}</td>
                    </tr>
                    <tr>
                        <td valign="top" style="text-indent:60px;">Addendum kontrak</td>
                        <td valign="top">:</td>
                        <td>Addendum</td>
                    </tr>
                    <tr>
                        <td style="text-indent:60px;padding-top:20px" colspan="3">Maka dengan ini disampaikan kepada
                            saudara untuk
                            melaksanakan pekerjaan :</td>
                    </tr>
                    <tr>
                        <td style="text-indent:80px; font-weight:bold;" colspan="3">{{ $pokhs->pekerjaan }}</td>
                    </tr>
                    <!-- <tr>
                        <td colspan="2" style="text-indent:80px;font-weight:bold;">Lokasi</td>
                        <td>:</td>

                    </tr> -->
                    {{-- @if (count($lokasis) == 1)
                        @foreach ($lokasis as $lokasi)
                            <tr style="font-weight:bold; height: 10px;">
                                <td style="height: 10px;" colspan="3" style="text-indent:80px;font-weight:bold;">
                                    {{ $lokasi->nama_lokasi }}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        @foreach ($lokasis as $lokasi)
                            <tr style="font-weight:bold; height: 10px;">
                                <td width="5%"></td>
                                <td width="3%">
                                    {{ $loop->iteration }}.
                                </td>
                                <td width="2%"></td>
                                <td width="90%">
                                    {{ $lokasi->nama_lokasi }}
                                </td>
                            </tr>
                        @endforeach
                    @endif --}}



                </table>
                @if (count($lokasis) == 1)
                    <ol type="none"
                        style="text-transform:uppercase; margin-top:10px; margin-left: 40px; margin-right: 10px; font-weight:bold; text-align:justify;">
                        @foreach ($lokasis as $lokasi)
                            <li>{{ $lokasi->nama_lokasi }}</li>
                        @endforeach
                    </ol>
                @else
                    <ol type="1"
                        style="text-transform:uppercase; margin-bottom:-5px; margin-top:10px; margin-left: 55px; margin-right: 10px; font-weight:bold; text-align:justify;">
                        @foreach ($lokasis as $lokasi)
                            <li style="margin-bottom: 5px;">{{ $lokasi->nama_lokasi }}</li>
                        @endforeach
                    </ol>
                @endif

            </div>
            <div class="content3" style="margin-left: 40px; margin-right: -5px;">
                <ol type="1" style="justify-content: space-between">
                    <li>Harga Borongan Pekerjaan <b>@currency($pokhs->total_harga),-</b> (Termasuk PPN 11%)</li>
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
                    <li>Sebelum melakukan pekerjaan agar berkoordinasi dengan ULP terkait sebagai tindak lanjut
                        monitoring jadwal padam, K3L, dan hal lain yang menjadi perhatian.</li>
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
                                @foreach (explode('&', $redaksi->sub_deskripsi_id) as $poin)
                                    <ul type="none" style="list-style-position: inside; padding-left: 0;">
                                        <li>{{ $poin }}</li>
                                    </ul>
                                @endforeach
                            @endif
                        </li>
                    @endforeach



                </ol>
                {{-- <div class="page-break"> </div>
                <div style="margin-left:23px; margin-right:-5px; justify-content: space-between;">
                    <p class="justifytb" style="left:40px; margin-right:-5px; justify-content: space-between;">
                        Apabila SPBJ/PO ini saudara(i) setuju dan sanggup melaksanakan, harap menandatangani SPBJ/PO ini
                        dan dikembalikan kepada kami untuk proses lebih lanjut.
                        <br>
                        SPBJ/PO ini dibuat dalam 3 (tiga) rangkap, asli dan 1 (satu) turunannya dibubuhi materai
                        secukupnya dan mempunyai kekuatan hukum yang sama.
                    </p>
                </div>

                <p style="text-indent:24px;">Demikian SPBJ/PO ini dibuat untuk dilaksanakan dan dapat diselesaikan
                    dengan sebaik-baiknya.</p> --}}
            </div>
            <table class="tableSection" width="85%" border="0" cellspacing="0" cellpadding="0" align="center"
                nobr="true" style="page-break-inside: avoid;">
                <!-- <tr>
                    <td colspan="2">
                        Apabila SPBJ/PO ini saudara(i) setuju dan sanggup melaksanakan, harap menandatangani SPBJ/PO ini
                        dan dikembalikan kepada kami untuk proses lebih lanjut.
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        SPBJ/PO ini dibuat dalam 3 (tiga) rangkap, asli dan 1 (satu) turunannya dibubuhi materai
                        secukupnya dan mempunyai kekuatan hukum yang sama.
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        Demikian SPBJ/PO ini dibuat untuk dilaksanakan dan dapat diselesaikan dengan sebaik-baiknya.
                    </td>
                </tr> -->
                <tr nobr="true">
                    <td class="justifytb" colspan="2" style="text-align:justify; padding-right:37px;"> Apabila
                        SPBJ/PO ini saudara(i)
                        setuju dan sanggup melaksanakan, harap
                        menandatangani SPBJ/PO ini
                        dan dikembalikan kepada kami untuk proses lebih lanjut.
                        <br class="justifytb">
                        SPBJ/PO ini dibuat dalam 3 (tiga) rangkap, asli dan 1 (satu) turunannya dibubuhi materai
                        secukupnya dan mempunyai kekuatan hukum yang sama.
                    </td>
                </tr>
                <tr>

                    <td valign="bottom" class="tabellkanan1" colspan="2" style="text-align:justify; height: 33px">
                        Demikian SPBJ/PO ini dibuat untuk dilaksanakan dan dapat diselesaikan
                        dengan sebaik-baiknya.
                    </td>

                </tr>
                <tr>
                    <td style="height: 50px; padding-left:40px" align="center" valign="bottom">SETUJU MELAKSANAKAN</td>
                <td style="width:43%; padding-left:40px" align="center" valign="bottom">PT PLN (PERSERO) UID
                        SULSELRABAR</td>
                </tr>
                <tr>
                    <td align="center" valign="top">{{ $pokhs->nomor_kontraks->vendors->nama_vendor }}</td>
                    <td align="center" valign="middle">UP3 MAKASSAR SELATAN</td>
                </tr>
                <tr>
                    <td align="center" valign="top">Direktur</td>
                    <td align="center" valign="middle">{{ $jabatan_manager }}</td>
                </tr>
                <tr style="height: 93px;">
                    <td style="height: 93px;" align="center" valign="bottom">
                        <b>{{ $pokhs->nomor_kontraks->vendors->nama_direktur }}</b>
                    </td>
                    <td align="center" valign="bottom"><b>{{ $nama_manager }}</b></td>
                </tr>
            </table>
        @endforeach


        {{-- <div class="fage-break"></div> --}}


    </main>

    <div class="page-break"></div>

    @foreach ($po_khs as $pokhs)
        <table class="sub-judul" width="95%" cellspacing="0" cellpadding="0" align="center">
            <tr>
                <td colspan="3" class="judul">RINCIAN ANGGARAN BIAYA</td>
            </tr>
            <tr>
                <td width="18%" style="height: 4px;">NAMA PEKERJAAN</td>
                <td width="2%" style="height: 4px;">:</td>
                <td width="80%" style="height: 4px;">{{ $pokhs->pekerjaan }}</td>
            </tr>
            <tr>
                <td> NO KONTRAK</td>
                <td>:</td>
                <td>0123908124</td>
            </tr>
            <tr>
                <td> NO SPBJ</td>
                <td>:</td>
                <td>0123908124</td>
            </tr>
            <tr>
                <td>SUMBER DANA</td>
                <td>:</td>
                <td>{{ $pokhs->skks->nomor_skk }}</td>
            </tr>
            <tr>
                <td valign="top">DAERAH KERJA</td>
                <td valign="top">:</td>

                <td valign="top">
                    @if (count($lokasis) == 1)
                        @foreach ($lokasis as $lokasi)
                            {{ $lokasi->nama_lokasi }}
                        @endforeach
                        {{-- <ul type="none">

                            @foreach ($lokasis as $lokasi)
                                <li>
                                    {{ $lokasi->nama_lokasi }}
                                </li>
                            @endforeach
                        </ul> --}}
                    @else
                        <ol type="1" style="padding-left:15px; margin-bottom:-3px; margin-top:-3px;">
                            @foreach ($lokasis as $lokasi)
                                <li>
                                    {{ $lokasi->nama_lokasi }}
                                </li>
                            @endforeach
                        </ol>
                    @endif

                </td>
                {{-- <td>{{ $pokhs->lokasi }}</td> --}}
            </tr>
            <tr>
                <td>PENYEDIA BARANG/JASA</td>
                <td>:</td>
                <td>{{ $pokhs->prks->no_prk }}</td>
            </tr>
        </table>
    @endforeach
    <div class="wrapword" id="firstTable">
        <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
            <tr class="warna">
                <td class="tabelataskiri" style="width:4%;" rowspan="2" align="center" valign="middle">No</td>
                <td class="tabelatas" rowspan="2" align="center" valign="middle">Uraian</td>
                <td class="tabelatas" style="width:10%;" rowspan="2" align="center" valign="middle">SAT.</td>
                <td class="tabelatas" style="width:9%;" rowspan="2" align="center" valign="middle">VOLUME</td>
                <td class="tabelataskanan" style="width:25%;" colspan="2" align="center" valign="middle">Harga
                </td>
            </tr>
            <tr class="warna">
                <td class="tabelnormal" style="width:12%;" align="center" valign="middle">Satuan (RP)</td>
                <td class="tabelnormalkanan"style="width:12%;" align="center" valign="middle">Jumlah (RP)</td>
            </tr>
            @if (count($kategori_jasa) > 0)
                <tr id="tr_jasa">
                    <td class="firstkiri" align="center" valign="middle"></td>
                    <td class="first tabellkiri" style="font-weight: bold; height: 17px;" align="left"
                        valign="top">JASA:</td>
                    <td class="first" align="center" valign="middle"></td>
                    <td class="first" align="center" valign="middle"></td>
                    <td class="first tabellkanan" align="right" valign="middle"></td>
                    <td class="firstkanan tabellkanan" align="right" valign="middle"></td>
                </tr>
                @foreach ($kategori_jasa as $jasa)
                    <tr>
                        <td class="firstkiri" align="center" valign="middle">{{ $loop->iteration }}</td>
                        <td class="first tabellkiri" align="left" valign="middle">
                            {{ $jasa->rincian_induks->nama_item }}
                        </td>
                        <td class="first" align="center" valign="middle">{{ $jasa->satuans->singkatan }}</td>
                        <td class="first" align="center" valign="middle">@currency3($jasa->volume)</td>
                        <td class="first tabellkanan" align="right" valign="middle">@currency2($jasa->harga_satuan)</td>
                        <td class="firstkanan tabellkanan" align="right" valign="middle">@currency2($jasa->jumlah_harga)</td>
                    </tr>
                @endforeach
                @if (count($kategori_material) > 0)
                    <tr>
                        <td class="firstkiri" align="center" valign="middle"><br></td>
                        <td class="first tabellkiri" style="font-weight: bold" align="left" valign="middle"></td>
                        <td class="first" align="center" valign="middle"></td>
                        <td class="first" align="center" valign="middle"></td>
                        <td class="first tabellkanan" align="right" valign="middle"></td>
                        <td class="firstkanan tabellkanan" align="right" valign="middle"></td>
                    </tr>
                @endif
            @endif
            @if (count($kategori_material) > 0)
                <tr id="tr_material">
                    <td class="firstkiri" align="center" valign="middle"></td>
                    <td class="first tabelnormallkiri" style="font-weight: bold; height: 17px;" align="left"
                        valign="top">
                        MATERIAL:
                    </td>
                    <td class="first" align="center" valign="middle"></td>
                    <td class="first" align="center" valign="middle"></td>
                    <td class="first tabellkanan" align="right" valign="middle"></td>
                    <td class="firstkanan tabelnormallkanan" align="right" valign="middle"></td>
                </tr>
                @foreach ($kategori_material as $material)
                    <tr>
                        <td class="firstkiri" align="center" valign="middle">{{ $loop->iteration }}</td>
                        <td class="first tabelnormallkiri" align="left" valign="middle">
                            {{ $material->rincian_induks->nama_item }}
                        </td>
                        <td class="first" align="center" valign="middle">{{ $material->satuans->singkatan }}</td>
                        <td class="first" align="center" valign="middle">{{ $material->volume }}</td>
                        <td class="first tabellkanan" align="right" valign="middle">@currency2($material->harga_satuan)</td>
                        <td class="firstkanan tabelnormallkanan tabellkanan" align="right" valign="middle">
                            @currency2($material->jumlah_harga)
                        </td>
                    </tr>
                @endforeach
            @endif
            <tr>
                <td class="tabelnormalkiri" rowspan="3" colspan="3"></td>
                <td class="tabelnormal" colspan="2" align="center" valign="middle"><b>Jumlah</b></td>
                <td class="tabelnormalkanan tabellkanan" align="right"><b>@currency2($jumlah)</b></td>
            </tr>
            <tr style="page-break-before: avoid">
                <td class="tabelnormal" colspan="2" align="center" valign="middle"><b>PPN 11%</b></td>
                <td class="tabelnormalkanan tabellkanan" align="right"><b>@currency2($ppn)</b></td>
            </tr>
            @foreach ($po_khs as $pokhs)
                <tr style="page-break-before: avoid">
                    <td class="tabelnormal" colspan="2" align="center" valign="middle"><b>TOTAL</b></td>
                    <td class="tabelnormalkanan tabellkanan" align="right"><b>@currency2($pokhs->total_harga)</b></td>
                </tr>
                <tr style="page-break-before: avoid">
                    <td class="tabelkiri"></td>
                    <td class="tabelnormalkanan2" rowspan="2" colspan="5"
                        style="font-weight: bold; font-style:italic;">
                        Terbilang: {{ Terbilang::make($pokhs->total_harga, ' rupiah') }}</td>
                </tr>
                <tr style="page-break-before: avoid">
                    <td class="tabelbawahkiri"></td>
                </tr>
            @endforeach
            <tr style="page-break-before: avoid">
                <td class="first10" colspan="2" style="height: 30px;" align="center" valign="bottom">Mengetahui
                </td>
                <td class="first10" colspan="4" style="width:35%;" align="center" valign="bottom">Makassar,
                    {{ \Carbon\Carbon::parse($pokhs->startdate)->isoFormat('DD MMMM YYYY') }}</td>
            </tr>
            <tr style="page-break-before: avoid">
                <td class="noborder" colspan="2" align="center" valign="top">{{ $jabatan_manager }}</td>
                <td class="noborder centertb" colspan="4" align="center" valign="middle"
                    style="padding-left: 30px; padding-right: 30px; text-align: center;">
                    {{ $pokhs->pejabats->jabatan }}
                </td>
            </tr>
            <tr style="height: 92px; page-break-before: avoid">
                <td class="noborder" colspan="2" style="height: 92px;" align="center" valign="bottom">
                    <b>{{ $nama_manager }}</b>
                </td>
                <td class="noborder" colspan="4" align="center" valign="bottom">
                    <b>{{ $pokhs->pejabats->nama_pejabat }}</b>
                </td>
            </tr>
        </table>
        <!-- <div style="page-break-before: avoid"></div> -->
        <!-- <table class="wrapword" width="95%" border="0" cellspacing="0" cellpadding="0" align="center" >
            <tr>
                <td style="height: 30px;" align="center" valign="bottom">Mengetahui</td>
                <td style="width:36%;" align="center" valign="bottom">Makassar,
                    {{ \Carbon\Carbon::parse($pokhs->tanggal_po)->isoFormat('DD MMMM YYYY') }}</td>
            </tr>
            <tr>
                <td align="center" valign="top">{{ $jabatan_manager }}</td>
                <td align="center" valign="middle">{{ $pokhs->pejabats->jabatan }}</td>
            </tr>
            <tr style="height: 85px;">
                <td style="height: 85px;" align="center" valign="bottom"><b>{{ $nama_manager }}</b></td>
                <td align="center" valign="bottom"><b>{{ $pokhs->pejabats->nama_pejabat }}</b></td>
            </tr>
        </table> -->
    </div>


</body>

</html>

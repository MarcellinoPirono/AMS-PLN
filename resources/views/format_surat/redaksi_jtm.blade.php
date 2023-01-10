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
                        <td valign="top" style="text-indent:60px;">Pekerjaan</td>
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

                    </tr>
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
                        dengan tanggal <b>{{ \Carbon\Carbon::parse($pokhs->enddate)->isoFormat('DD MMMM YYYY') }}.</b>
                    </li>
                    <li>Sumber Dana Sesuai dengan SKK <b>{{ $pokhs->skks->nomor_skk }} <br> PRK No:
                            {{ $pokhs->prks->no_prk }}.</b></li>
                    <li>Direksi Pekerjaan adalah <b>{{ $pokhs->pejabats->jabatan }} PT PLN (Persero) UP3
                            Makassar
                            Selatan.</b></li>
                    <li>Sebelum melakukan pekerjaan agar berkoordinasi dengan ULP terkait sebagai tindak lanjut
                        monitoring jadwal padam, K3L, dan hal lain yang menjadi perhatian.</li>
                    <li>Pengawas Pekerjaan adalah <b>{{ $pokhs->pengawas }}</b> PT PLN (Persero) UP3 Makassar Selatan.
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
                    <td style="width:43%; padding-left:40px" align="center" valign="bottom">PT PLN (PERSERO) UIW
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


    </main>


</body>

</html>

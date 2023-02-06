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
        <img class="mt-1" src="{{ public_path('/') }}./asset/frontend/images/header_pln.jpg" alt="">
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
                <table class=" ml-2" style="width:84%;" id="rincian" cellspacing="0"
                    cellpadding="0" align="center" border="0">
                    <tr class="">
                        <td style="width:12%;">Nomor
                        </td>
                        <td style="width:45%">: {{ $pokhs->nomor_po }}</td>
                        <td colspan="2">
                            {{ \Carbon\Carbon::parse($pokhs->startdate)->isoFormat('dddd, DD MMMM YYYY') }}</td>
                    </tr>
                    <tr class="noborder">
                        <td style="">Lamp.</td>
                        <td>: 1(satu) Set</td>
                        <td colspan="2"></td>
                    </tr>
                    <tr class="noborder">
                        <td style="">Perihal</td>
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
                        <td></td>
                    </tr>
                    <tr class="noborder">
                        <td></td>
                        <td></td>
                        <td colspan="2" class="" style="text-align: justify; padding-right: 7px;">{{ $pokhs->nomor_kontraks->vendors->alamat_kantor_1 }}</td>
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
                <table width="92%" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="3" style="text-indent:60px; ">Menunjuk Kontrak Perjanjian Sebagai
                            Berikut</td>
                    </tr>
                    <tr>
                        <td width="23%" style="text-indent:60px;" valign="top">Kontrak Nomor</td>
                        <td width="2%" valign="top">:</td>
                        <td width="67%" valign="top">{{ $pokhs->nomor_kontraks->nomor_kontrak_induk }}</td>
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

                </table>
                @if (count($lokasis) == 1)
                    <ol type="none"
                        style="text-transform:uppercase; margin-top:10px; margin-left: 150px; margin-right: 10px; font-weight:bold; text-align:justify;">
                        @foreach ($lokasis as $lokasi)
                            <li>{{ $lokasi->nama_lokasi }}</li>
                        @endforeach
                    </ol>
                @else
                    <ol type="1"
                        style="text-transform:uppercase; margin-bottom:-5px; margin-top:10px; margin-left: 170px; margin-right: 10px; font-weight:bold; text-align:justify;">
                        @foreach ($lokasis as $lokasi)
                            <li style="margin-bottom: 5px;">{{ $lokasi->nama_lokasi }}</li>
                        @endforeach
                    </ol>
                @endif

            </div>
            <div class="content3" style="margin-left: 40px; margin-right: -33px;">
                <ol type="1" style="justify-content: space-between">
                    <li>Harga Borongan Pekerjaan <b>@currency($pokhs->total_harga),-</b> (Termasuk PPN {{ $ppn_id[0]->ppn }}%)</li>
                    <li>Jangka waktu pelaksanaan pekerjaan <b>{{ $days }}</b> <span
                           >({{ Terbilang::make($days) }})</span> hari kalender sejak tanggal
                        <b>{{ \Carbon\Carbon::parse($pokhs->startdate)->isoFormat('DD MMMM YYYY') }}</b>
                        sampai
                        dengan tanggal <b>{{ \Carbon\Carbon::parse($pokhs->enddate)->isoFormat('DD MMMM YYYY') }}</b>
                    </li>
                    <li>Sumber Dana Sesuai dengan SKK <b>{{ $pokhs->skks->nomor_skk }} <br> PRK No:
                            {{ $pokhs->prks->no_prk }}</b></li>
                    <li>Direksi Pekerjaan adalah <b>{{ $pokhs->pejabats->jabatan }} PT PLN (Persero) UP3
                            Makassar
                            Selatan</b></li>
                    <li>Pengawas Pekerjaan adalah <b>{{ $pokhs->pengawas_pekerjaan }}</b> PT PLN (Persero) UP3 Makassar Selatan
                    </li>
                    @if ($pokhs->pengawas_lapangan != null)
                        <li>Pengawas Lapangan adalah <b>{{ $pokhs->pengawas_lapangan }}</b></li>
                    @endif
                    <li>Tempat Penyerahan pekerjaan di Kantor PT PLN (Persero) UP3 Makassar Selatan Jl.
                        Hertasning
                        No.99
                        Rappocini - Makassar dilengkapi dengan realisasi perintah kerja yang sudah selesai
                        dilaksanakan.
                    </li>
                    @foreach ($rabredaksi_array as $redaksi)
                    <li>
                        {{$redaksi["redaksi"]}}
                        <ol type="a" style="padding-left:15px; ">
                        @foreach ($redaksi["sub_redaksi"] as $poin)
                            @if ($poin->sub_deskripsi != null)
                                <li>{{$poin->sub_deskripsi}};</li>
                            @endif
                        @endforeach
                        </ol>
                    </li>
                    @endforeach
                </ol>

            </div>
            <table class="tableSection" width="85%" border="0" cellspacing="0" cellpadding="0" align="center" nobr="true"
                style="page-break-inside: avoid;">

                <tr nobr="true">
                    <td class="justifytb" colspan="2" style="text-align:justify; padding-right:15px;"> Apabila SPBJ/PO ini saudara(i)
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
                    <td style="width:43%; padding-left:40px" align="center" valign="bottom">PT PLN (PERSERO) UIW SULSELRABAR</td>
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
                <tr style="margin-top:50px">
                    @if (count($tembusans) > 0)
                    <td valign="bottom" align="left">Tembusan :</td>
                    @else
                    <td valign="bottom" align="left"></td>
                    @endif
                </tr>
                @if (count($tembusans) > 0)
                @foreach ($tembusans as $tembusan)
                <tr>
                    <td colspan="3">- {{$tembusan->isi_tembusan}}</td>
                </tr>
                @endforeach
                @endif
            </table>
        @endforeach

    </main>


</body>

</html>

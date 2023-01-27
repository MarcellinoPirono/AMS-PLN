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
        <tr class="warna" >
            <td class="tabelataskiri" style="width:4%;" rowspan="2" align="center" valign="middle">No</td>
            <td class="tabelatas" rowspan="2" align="center" valign="middle">Uraian Pekerjaan</td>
            <td class="tabelatas" style="width:10%;" rowspan="2" align="center" valign="middle">Satuan</td>
            <td class="tabelatas" style="width:9%;" rowspan="2" align="center" valign="middle">Volume</td>
            <td class="tabelataskanan" style="width:25%;" colspan="2" align="center" valign="middle">Harga
            </td>
        </tr>
        <tr class="warna">
            <td class="tabelnormal" style="width:12%;" align="center" valign="middle">Satuan (RP)</td>
            <td class="tabelnormalkanan"style="width:12%;" align="center" valign="middle">Jumlah (RP)</td>
        </tr>


            @foreach ($lokasis as $key => $value)
                <tr id="tr_jasa">
                    <td class="firstkiri tabelpaket1" align="center" valign="middle" style="font-weight: bold;">
                        {{ $loop->iteration }}</td>
                    <td class="first tabellkiri tabelpaket" style="font-weight: bold; height: 17px;" align="left"
                        valign="top">
                        {{ $value->nama_lokasi }}:</td>
                    <td class="first tabelpaket" align="center" valign="middle"></td>
                    <td class="first tabelpaket" align="center" valign="middle"></td>
                    <td class="first tabellkanan tabelpaket" align="right" valign="middle"></td>
                    <td class="firstkanan tabelpaket2" align="center" valign="middle"></td>
                </tr>
                @foreach ($paket_id[$key] as $key1 => $value1)
                    <tr id="tr_jasa">
                        <td class="firstkiri"align="center"valign="middle"style="font-weight:bold;">{{ Terbilang::roman($loop->iteration) }}</td>
                        <td class="first tabellkiri" style="font-weight: bold; height: 17px;" align="left"
                            valign="top">
                            {{ $value1->nama_paket }}:</td>
                        <td class="first" align="center" valign="middle"></td>
                        <td class="first" align="center" valign="middle"></td>
                        <td class="first tabellkanan" align="right" valign="middle"></td>
                        <td class="firstkanan" align="center" valign="middle"></td>
                    </tr>
                    @if (count($kategori_material[$key][$key1]) > 0)
                        <tr id="tr_material">
                            <td class="firstkiri" align="center" valign="middle"></td>
                            <td class="first tabellkiri" style="font-weight: bold; height: 17px;"
                                align="left" valign="top"> MATERIAL:
                            </td>
                            <td class="first" align="center" valign="middle"></td>
                            <td class="first" align="center" valign="middle"></td>
                            <td class="first tabellkanan" align="right" valign="middle"></td>
                            <td class="firstkanan tabelnormallkanan" align="right" valign="middle"></td>
                        </tr>
                        @php
                            $char = 1;
                            $albha = 'a';
                            $char < 'z';
                        @endphp
                        @foreach ($kategori_material[$key][$key1] as $key3 => $value3)
                            <tr>
                                <td class="firstkiri" align="center" valign="middle">{{ $albha++ }}</td>
                                <td class="first tabellkiri" align="left" valign="middle">

                                    {{ $value3->rincian_induks->nama_item }}
                                </td>
                                <td class="first" align="center" valign="middle">
                                    {{ $value3->satuans->singkatan }}</td>
                                <td class="first" align="center" valign="middle">{{ $value3->volume }}</td>
                                <td class="first tabellkanan" align="right" valign="middle">@currency2($value3->harga_satuan)
                                </td>
                                <td class="firstkanan tabellkanan" align="right" valign="middle">
                                    @currency2($value3->jumlah_harga)
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="firstkiri" align="center" valign="middle"></td>
                            <td class="first tabellkiri" align="left" valign="middle"
                                style="font-weight: bold; height: 17px;"> SUB-JUMLAH:
                            </td>
                            <td class="first" align="center" valign="middle"></td>
                            <td class="first" align="center" valign="middle"></td>
                            <td class="first tabellkanan" align="right" valign="middle"></td>
                            <td class="firstkanan tabellkanan" align="right" valign="middle"><b>@currency2($sub_jumlah_material_paket[$key][$key1])</b>
                            </td>
                        </tr>
                    @endif
                    @if (count($kategori_jasa[$key][$key1]) > 0)
                        <tr id="tr_jasa">
                            <td class="firstkiri" align="center" valign="middle"></td>
                            <td class="first tabellkiri" style="font-weight: bold; height: 17px;" align="left"
                                valign="top">
                                JASA:</td>
                            <td class="first" align="center" valign="middle"></td>
                            <td class="first" align="center" valign="middle"></td>
                            <td class="first tabellkanan" align="right" valign="middle"></td>
                            <td class="firstkanan" align="center" valign="middle"></td>
                        </tr>
                        @php
                            $char = 1;
                            $albha = 'a';
                            $char < 'z';
                        @endphp
                        @foreach ($kategori_jasa[$key][$key1] as $key2 => $value2)
                            <tr>
                                <td class="firstkiri" align="center" valign="middle">{{ $albha++ }}</td>
                                <td class="first tabellkiri" align="left" valign="middle">
                                    {{ $value2->rincian_induks->nama_item }}
                                </td>
                                <td class="first" align="center" valign="middle">
                                    {{ $value2->satuans->singkatan }}</td>
                                <td class="first" align="center" valign="middle">@currency2($value2->volume)</td>
                                <td class="first tabellkanan" align="right" valign="middle">@currency2($value2->harga_satuan)
                                </td>
                                <td class="firstkanan tabellkanan" align="right" valign="middle">@currency2($value2->jumlah_harga)
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="firstkiri" align="center" valign="middle"></td>
                            <td class="first tabellkiri" align="left" valign="middle"
                                style="font-weight: bold; height: 17px;">SUB-JUMLAH:</td>
                            <td class="first" align="center" valign="middle"></td>
                            <td class="first" align="center" valign="middle"></td>
                            <td class="first tabellkanan" align="right" valign="middle"></td>
                            <td class="firstkanan tabellkanan" align="right" valign="middle"><b> @currency2($sub_jumlah_jasa_paket[$key][$key1]) </b>
                                </td>
                        </tr>
                        @if (count($kategori_material[$key][$key1]) > 0)
                            <tr>
                                <td class="firstkiri" align="center" valign="middle"><br></td>
                                <td class="first tabellkiri" style="font-weight: bold" align="left"
                                    valign="middle"></td>
                                <td class="first" align="center" valign="middle"></td>
                                <td class="first" align="center" valign="middle"></td>
                                <td class="first tabellkanan" align="right" valign="middle"></td>
                                <td class="firstkanan tabellkanan" align="right" valign="middle"></td>
                            </tr>
                        @endif
                    @endif

                @endforeach
            @endforeach
            <tr style="page-break-before: avoid">
                <td class="tabelnormalkiri" rowspan="5" colspan="3"></td>
                <td class="tabelnormal" colspan="2" align="center" valign="middle"><b>Jumlah Material</b></td>
                <td class="tabelnormalkanan tabellkanan" align="right"><b>@currency2($sub_jumlah_material)</b></td>
            </tr>
            <tr>
                <td class="tabelnormal" colspan="2" align="center" valign="middle"><b>Jumlah Jasa</b></td>
                <td class="tabelnormalkanan tabellkanan" align="right"><b>@currency2($sub_jumlah_jasa)</b></td>
            </tr>

            <tr style="page-break-before: avoid">
                <td class="tabelnormal" colspan="2" align="center" valign="middle"><b>Jumlah Keseluruhan</b></td>
                <td class="tabelnormalkanan tabellkanan" align="right"><b>@currency2($jumlah)</b></td>
            </tr>
            <tr style="page-break-before: avoid">
                <td class="tabelnormal" colspan="2" align="center" valign="middle"><b>PPN {{$ppn_id[0]->ppn}}%</b></td>
                <td class="tabelnormalkanan tabellkanan" align="right"><b>@currency2($ppn)</b></td>
            </tr>
            @foreach ($po_khs as $pokhs)
                <tr style="page-break-before: avoid">
                    <td class="tabelnormal" colspan="2" align="center" valign="middle"><b>TOTAL</b></td>
                    <td class="tabelnormalkanan tabellkanan kuning" align="right"><b>@currency2($pokhs->total_harga)</b></td>
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
                <td style="text-align: center" class="noborder centertb" colspan="2" align="center" valign="top">{{ $jabatan_manager }}</td>
                <td style="text-align: center" class="noborder centertb" colspan="4" align="center" valign="middle"
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
    </div>


</body>

</html>

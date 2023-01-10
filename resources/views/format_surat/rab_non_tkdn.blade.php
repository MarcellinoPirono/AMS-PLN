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


    @foreach ($po_khs as $pokhs)
    <table class="sub-judul" width="95%" cellspacing="0" cellpadding="0" align="center">
        <tr>
            <td colspan="3" class="judul">RINCIAN ANGGARAN BIAYA NON-TKDN</td>
        </tr>
        <tr>
            <td width="18%" style="height: 4px;">PEKERJAAN</td>
            <td width="2%" style="height: 4px;">:</td>
            <td width="80%" style="height: 4px;">{{ $pokhs->pekerjaan }}</td>
        </tr>
        <tr>
            <td valign="top">LOKASI</td>
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
    <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr class="warna">
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
            <td class="noborder centertb" colspan="4" align="center" valign="middle" style="padding-left: 30px; padding-right: 30px; text-align: center;">{{ $pokhs->pejabats->jabatan }}
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

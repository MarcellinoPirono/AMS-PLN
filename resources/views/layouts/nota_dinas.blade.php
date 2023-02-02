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
    @foreach ($non_po as $nonpo)
        <table class="sub-judul" width="95%" cellspacing="0" cellpadding="0" align="center">
            <tr>
                <td colspan="3" class="judul1" valign="bottom">Rencana Pengadaan Barang & Jasa </td>
                <!-- <td colspan="3" class="sub-judul">{{ $nonpo->nomor_rpbj }}</td> -->
            </tr>
            <tr style="height: 10px;">
                <td colspan="3" class="sub-judul"" align="center" valign="top">No: {{ $nonpo->nomor_rpbj }}</td>
            </tr>
            <tr>
                <td width="18%" style="height: 4px;">PEKERJAAN</td>
                <td width="2%" style="height: 4px;">:</td>
                <td width="75%" style="height: 4px;">{{ $nonpo->pekerjaan }}</td>
            </tr>
            <tr>
                <td>SUMBER ANGGARAN</td>
                <td>:</td>
                <td>{{ $nonpo->skks->nomor_skk }}</td>
            </tr>
            <tr>
                <td>NOMOR PRK</td>
                <td>:</td>
                <td>{{ $nonpo->prks->no_prk }}</td>
            </tr>
        </table>
    @endforeach
    <div class="wrapword" id="firstTable">
        <table class="black" width="95%" border="2" cellspacing="0" cellpadding="0" align="center">
            <tr class="warna">
                <td style="width:4%;" rowspan="2" align="center" valign="middle">No</td>
                <td rowspan="2" align="center" valign="middle">Uraian Pekerjaan</td>
                <td style="width:12%;" rowspan="2" align="center" valign="middle">Satuan</td>
                <td style="width:9%;" rowspan="2" align="center" valign="middle">Volume</td>
                <td style="width:25%;" colspan="2" align="center" valign="middle">Harga</td>
            </tr>
            <tr class="warna">
                <td style="width:12%;" align="center" valign="middle">Satuan (RP)</td>
                <td style="width:15%;" align="center" valign="middle">Jumlah (RP)</td>
            </tr>
            @foreach ($rab_non_po as $rabnonpo)
                <tr>
                    <td class="first" align="center" valign="middle">{{ $loop->iteration }}</td>
                    <td class="first tabellkiri" align="left" valign="middle">{{ $rabnonpo->uraian }}</td>
                    <td class="first" align="center" valign="middle">{{ $rabnonpo->satuan }}</td>
                    <td class="first" align="center" valign="middle">{{ $rabnonpo->volume }}</td>
                    <td class="first tabellkanan" align="right" valign="middle">@currency2($rabnonpo->harga_satuan)</td>
                    <td class="first tabellkanan" align="right" valign="middle">@currency2($rabnonpo->jumlah_harga)</td>
                </tr>
            @endforeach
            <tr style="page-break-before: avoid">
                <td rowspan="3" colspan="3"></td>
                <td colspan="2" align="center" valign="middle"><b>Jumlah</b></td>
                <td class="tabellkanan" align="right"><b>@currency2($jumlah)</b></td>
            </tr>
            <tr style="page-break-before: avoid">
                <td colspan="2" align="center" valign="middle"><b>PPN 11%</b></td>
                <td class="tabellkanan" align="right"><b>@currency2($ppn)</b></td>
            </tr>
            @foreach ($non_po as $nonpo)
                <tr style="page-break-before: avoid">
                    <td colspan="2" align="center" valign="middle"><b>TOTAL</b></td>
                    <td class="tabellkanan" align="right"><b>@currency2($nonpo->total_harga)</b></td>
                </tr>
                <tr style="page-break-before: avoid">
                    <td class="first1"></td>
                    <td class="first2" rowspan="2" colspan="5" style="font-weight: bold; font-style:italic;">
                        Terbilang: {{ Terbilang::make($nonpo->total_harga, ' rupiah') }}</td>
                </tr>
                <tr style="page-break-before: avoid">
                    <td class="first1"></td>
                </tr>
            @endforeach
        </table>
    </div>

    <table width="95%" border="0" cellspacing="0" cellpadding="0">
        <tr style="page-break-before: avoid">
            <td style="height: 50px;" align="center" valign="bottom">Dibuat Oleh</td>
            <td style="width:40%;" align="center" valign="bottom">Mengetahui</td>
        </tr>
        <tr style="page-break-before: avoid">
            <td align="center" valign="top">{{ $nonpo->supervisor }}</td>
            <td align="center" valign="middle" style="float:left;">{{ $nonpo->pejabats->jabatan }}</td>
        </tr>
        <tr style="height: 110px; page-break-before: avoid">
            <td style="height: 110px;" align="center" valign="bottom">{{$nonpo->users->name}}</td>
            <td align="center" valign="bottom">{{ $nonpo->pejabats->nama_pejabat }}</td>
        </tr>
    </table>
</body>

</html>


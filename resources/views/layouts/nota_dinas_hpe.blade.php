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

    @foreach ($non_po as $nonpo)
        <table class="sub-judul" width="100%" cellspacing="0" cellpadding="0">
            <tr>
                <td colspan="3" class="judul1" valign="bottom">Rencana Pengadaan Barang & Jasa </td>
                <!-- <td colspan="3" class="sub-judul">{{ $nonpo->nomor_rpbj }}</td> -->
            </tr>
            <tr style="height: 10px;">
                <td colspan="3" class="sub-judul" align="center" valign="top">No: {{ $nonpo->nomor_rpbj }}</td>
            </tr>
            <tr>
                <td width="18%">PEKERJAAN</td>
                <td width="2%">:</td>
                <td width="80%">{{ $nonpo->pekerjaan }}</td>
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
        <table width="100%" border="2" cellspacing="0" cellpadding="0">
            <tr class="warna">
                <td style="width:4%;" rowspan="2" align="center" valign="middle">No</td>
                <td rowspan="2" align="center" valign="middle">Uraian Pekerjaan</td>
                <td style="width:12%;" rowspan="2" align="center" valign="middle">Satuan</td>
                <td style="width:9%;" rowspan="2" align="center" valign="middle">Volume</td>
                <td style="width:25%;" colspan="2" align="center" valign="middle">Harga</td>
                <td style="width:25%;" colspan="2" align="center" valign="middle">Harga Perkiraan</td>
            </tr>
            <tr class="warna">
                <td style="width:12%;" align="center" valign="middle">Satuan (RP)</td>
                <td style="width:15%;" align="center" valign="middle">Jumlah (RP)</td>
            </tr>
            <tr class="warna">
                <td style="width:12%;" align="center" valign="middle">Harga Perkiraan (RP)</td>
                <td style="width:15%;" align="center" valign="middle">Jumlah Harga HPE (RP)</td>
            </tr>
            @foreach ($rab_hpes as $rab_hpe)
                <tr>
                    <td class="first" align="center" valign="middle">{{ $loop->iteration }}</td>
                    <td class="first" align="left" valign="middle">{{ $rab_hpe->rab_non_pos->uraian }}</td>
                    <td class="first" align="center" valign="middle">{{ $rab_hpe->rab_non_pos->satuan }}</td>
                    <td class="first" align="center" valign="middle">{{ $rab_hpe->rab_non_pos->volume }}</td>
                    <td class="first" align="right" valign="middle">@currency2($rab_hpe->rab_non_pos->harga_satuan)</td>
                    <td class="first" align="right" valign="middle">@currency2($rab_hpe->rab_non_pos->jumlah_harga)</td>
                    <td class="first" align="right" valign="middle">@currency2($rab_hpe->harga_perkiraan)</td>
                    <td class="first" align="right" valign="middle">@currency2($rab_hpe->jumlah_harga_perkiraan)</td>
                </tr>
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
            @foreach ($hpes as $hpe)
                <tr>
                    <td colspan="2" align="center" valign="middle"><b>TOTAL</b></td>
                    <td align="right"><b>@currency2($hpe->non_pos->total_harga)</b></td>
                    <td align="right"><b>@currency2($hpe->total_harga_hpe)</b></td>
                </tr>
                <tr>
                    <td class="first1"></td>
                    <td class="first2" rowspan="2" colspan="5" style="font-weight: bold; font-style:italic;">
                        Terbilang: {{ Terbilang::make($hpe->non_pos->total_harga, ' rupiah') }}</td>
                </tr>
                <tr>
                    <td class="first1"></td>
                </tr>
            @endforeach
        </table>
    </div>

    @foreach ($non_po as $nonpo)
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td style="height: 50px;" align="center" valign="bottom">Dibuat Oleh</td>
            <td style="width:35%;" align="center" valign="bottom">Mengetahui</td>
        </tr>
        <tr>
            <td align="center" valign="top">{{ $nonpo->supervisor }}</td>
            <td align="center" valign="middle">{{ $nonpo->pejabats->jabatan }}</td>
        </tr>
        <tr style="height: 150px;">
            <td style="height: 150px;" align="center" valign="bottom">Fadhil KH</td>
            <td align="center" valign="bottom">{{ $nonpo->pejabats->nama_pejabat }}</td>
        </tr>
    </table>
    @endforeach

</body>

</html>

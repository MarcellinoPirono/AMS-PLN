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
        <img class="mt-1 header-rab" src="{{ public_path('/') }}./asset/frontend/images/header_rab.png" alt="">
    </header>
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
                <td rowspan="2" align="center" valign="middle">Uraian</td>
                <td style="width:8%;" rowspan="2" align="center" valign="middle">Satuan</td>
                <td style="width:9%;" rowspan="2" align="center" valign="middle">Vol</td>
                <td style="width:21%;" colspan="2" align="center" valign="middle">Harga</td>
                <td style="width:25%;" colspan="2" align="center" valign="middle">Harga Perkiraan</td>
            </tr>
            <tr class="warna">
                <td style="width:9%;" align="center" valign="middle">Satuan (RP)</td>
                <td style="width:12%;" align="center" valign="middle">Jumlah (RP)</td>
                <td style="width:12%;" align="center" valign="middle">Harga Perkiraan (RP)</td>
                <td style="width:15%;" align="center" valign="middle">Jumlah Harga HPE (RP)</td>
            </tr>
            @foreach ($rab_hpes as $rab_hpe)
                <tr>
                    <td class="first" align="center" valign="middle">{{ $loop->iteration }}</td>
                    <td class="first tabellkiri" align="left" valign="middle">{{ $rab_hpe->rab_non_pos->uraian }}</td>
                    <td class="first" align="center" valign="middle">{{ $rab_hpe->rab_non_pos->satuan }}</td>
                    <td class="first" align="center" valign="middle">{{ $rab_hpe->rab_non_pos->volume }}</td>
                    <td class="first tabellkanan" align="right" valign="middle">@currency2($rab_hpe->rab_non_pos->harga_satuan)</td>
                    <td class="first tabelnormallkanan tabellkanan" align="right" valign="middle">@currency2($rab_hpe->rab_non_pos->jumlah_harga)</td>
                    <td class="first tabellkanan" align="right" valign="middle">@currency2($rab_hpe->harga_perkiraan)</td>
                    <td class="first tabelnormallkanan tabellkanan" align="right" valign="middle">@currency2($rab_hpe->jumlah_harga_perkiraan)</td>
                </tr>
            @endforeach
            <tr style="page-break-before: avoid">
                <td class="tabelnormal" rowspan="3" colspan="2"></td>
                <td class="tabelnormal" colspan="2" align="center" valign="middle"><b>JUMLAH</b></td>
                <td class="tabelnormal tabellkanan" colspan="2" align="right"><b>@currency2($jumlah)</b></td>
                <!-- <td class="tabelnormal" colspan="1" align="center" valign="middle"><b>JUMLAH HPE</b></td> -->
                <td class="tabelnormal tabellkanan" colspan="2" align="right"><b>@currency2($jumlah_hpe)</b></td>
            </tr>
            <tr style="page-break-before: avoid">
                <td class="tabelnormal" colspan="2" align="center" valign="middle"><b>PPN 11%</b></td>
                <td class="tabelnormal tabellkanan" colspan="2" align="right"><b>@currency2($ppn)</b></td>
                <!-- <td class="tabelnormal" colspan="1" align="center" valign="middle"><b>PPN HPE 11%</b></td> -->
                <td class="tabelnormal tabellkanan" colspan="2" align="right"><b>@currency2($ppn_hpe)</b></td>
            </tr>
            @foreach ($hpes as $hpe)
            <tr style="page-break-before: avoid">
                <td class="tabelnormal" colspan="2" align="center" valign="middle"><b>TOTAL</b></td>
                <td class="tabelnormal tabellkanan" colspan="2" align="right"><b>@currency2($hpe->non_pos->total_harga)</b></td>
                <!-- <td class="tabelnormal" colspan="1" align="center" valign="middle"><b>TOTAL HPE</b></td> -->
                <td class="tabelnormal tabellkanan" colspan="2" align="right"><b>@currency2($hpe->total_harga_hpe)</b></td>
            </tr>
            <tr style="page-break-before: avoid">
                <td class="tabelkecualikananbawah"></td>
                <td class="tabelkecualikiri" rowspan="2" colspan="7" style="font-weight: bold; font-style:italic;">
                    Terbilang: {{ Terbilang::make($hpe->non_pos->total_harga, ' rupiah') }}</td>
            </tr>
            <tr style="page-break-before: avoid">
                <td class="tabelbawahkiri"></td>
            </tr>
            @endforeach
            @foreach ($non_po as $nonpo)
            <tr style="page-break-before: avoid">
                <td class="tabelkiri"></td>
                <td class="tabelkanan" colspan="2" style="font-weight: bold;">Lampiran</td>
                <td class="firstkanan tabellkiri" colspan="5" style="font-weight: bold;">Monitoring Anggaran</td>
            </tr>
            <tr style="page-break-before: avoid">
                <td class="tabelkiri"></td>
                <td class="tabelkanan" colspan="2"></td>
                <td class="first2 tabellkiri" colspan="1">SKK</td>
                <td class="tabelkanan" colspan="4">: {{$nonpo->skks->nomor_skk}}</td>
            </tr>
            <tr style="page-break-before: avoid">
                <td class="tabelkiri"></td>
                <td class="tabelkanan" colspan="2">Referensi Harga:</td>
                <td class="first2 tabellkiri" colspan="1">PRK</td>
                <td class="tabelkanan" colspan="4">: {{$nonpo->prks->no_prk}}</td>
            </tr>
                <td class="tabelkiri"></td>
                <td class="tabelkanan" colspan="2">Nota Dinas/Disposisi:</td>
                <td class="first2 tabellkiri" colspan="1">Saldo Awal</td>
                <td class="tabelkanan" colspan="4">: Rp. @currency2($nonpo->prks->pagu_prk)</td>
            <tr style="page-break-before: avoid">
                <td class="tabelkiri"></td>
                <td class="tabelkanan" colspan="2">Lain-Lain:</td>
                <td class="first2 tabellkiri" colspan="1">Terpakai</td>
                <td class="tabelkanan" colspan="4">: Rp. @currency2($nonpo->prks->prk_terkontrak)</td>
            </tr>
            <tr style="page-break-before: avoid">
                <td class="tabelbawahkiri"></td>
                <td class="tabelbawahkanan" colspan="2"></td>
                <td class="tabelbawah first2 tabellkiri" colspan="1">Saldo Akhir</td>
                <td class="tabelbawahkanan" colspan="4">: Rp. @currency2($nonpo->prks->prk_sisa)</td>
            </tr>
            @endforeach
            <tr style="page-break-before: avoid">
                <td class="tabelkiri"></td>
                <td class="tabelkanan" colspan="2"></td>
                <td class="tabelkanan" colspan="3" align="center" valign="middle">Verifikasi Anggaran</td>
                <td class="tabelkanan" colspan="2" align="center" valign="middle">Evaluasi HPE,</td>
            </tr>
            <tr style="page-break-before: avoid">
                <td class="tabelkiri"></td>
                <td class="tabelkanan" colspan="2" align="center" valign="middle">Catatan Keuangan :</td>
                <td class="tabelkanan" colspan="3" align="center" valign="middle">MANAJER BAGIAN KEUANGAN DAN UMUM</td>
                <td class="tabelkanan" colspan="2" align="center" valign="middle">MANAJER BAGIAN PERENCANAAN</td>
            </tr>
            <tr style="page-break-before: avoid">
                <td class="tabelkiri"></td>
                <td class="tabelkanan" colspan="2"></td>
                <td class="tabelkanan" colspan="3"></td>
                <td class="tabelkanan" colspan="2"></td>
            </tr>
            <tr style="page-break-before: avoid">
                <td class="tabelkiri"></td>
                <td class="tabelkanan" colspan="2"><label class="checkbox-label"><input type="checkbox">: Disetujui</label></td>
                <td class="tabelkanan" colspan="3"></td>
                <td class="tabelkanan" colspan="2"></td>
            </tr>
            <tr style="page-break-before: avoid">
                <td class="tabelkiri"></td>
                <td class="tabelkanan" colspan="2"></td>
                <td class="tabelkanan" colspan="3"></td>
                <td class="tabelkanan" colspan="2"></td>
            </tr>
            <tr style="page-break-before: avoid">
                <td class="tabelkiri"></td>
                <td class="tabelkanan" colspan="2"><label class="checkbox-label"><input type="checkbox">: Tidak Disetujui</label></td>
                <td class="tabelkanan" colspan="3"></td>
                <td class="tabelkanan" colspan="2"></td>
            </tr>
            <tr style="page-break-before: avoid">
                <td class="tabelkiri"></td>
                <td class="tabelkanan" colspan="2"></td>
                <td class="tabelkanan" colspan="3" align="center" valign="middle">JOHAN PRASETYA YUDHA PRAMUKTI</td>
                <td class="tabelkanan" colspan="2" align="center" valign="middle">YANUARDHI ARIEF BUDIYONO</td>
            </tr>
            <tr style="page-break-before: avoid">
                <td class="tabelbawahkiri"></td>
                <td class="tabelbawahkanan" colspan="2"></td>
                <td class="tabelbawahkanan" colspan="3"></td>
                <td class="tabelbawahkanan" colspan="2"></td>
            </tr>
        </table>
    </div>
</body>

</html>

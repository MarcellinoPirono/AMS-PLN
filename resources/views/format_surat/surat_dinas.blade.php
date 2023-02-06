<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ public_path('/') }}./asset/frontend/css/surat/postyle.css" rel="stylesheet" />

</head>

<body>
    <header1 class="mt-1">
        <div>
            PT. PLN (PERSERO)
        </div>
        <div>
            <b><u>UP3 MAKASSAR SELATAN</u></b>
        </div>
    </header1>

    @foreach ($surats as $surat)
    <table width="95%" cellspacing="0" cellpadding="0" align="center" style="padding-left: 25px">
        <tr>
            <td colspan="3" class="judul1" valign="bottom">NOTA DINAS </td>
        </tr>
        <tr style="height: 10px;">
            <td colspan="3" class="sub-judul" align="center" valign="top">Nomor: {{$surat->non_pos->nomor_rpbj}}</td>
        </tr>
        <tr>
            <td style="height: 4px; width: 10%">Kepada</td>
            <td style="height: 4px; width: 1%">:</td>
            <td style="height: 4px;">Yth. {{$surat->jabatan_penerima}} </td>
        </tr>
        <tr>
            <td>Dari</td>
            <td>:</td>
            <td>{{$surat->jabatan_pengirim}} </td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td> {{ \Carbon\Carbon::parse($surat->non_pos->startdate)->isoFormat('dddd, DD MMMM YYYY') }}</td>
        </tr>
        <tr>
            <td>Sifat</td>
            <td>:</td>
            <td>{{$surat->sifat}}</td>
        </tr>
        <tr>
            <td>Lampiran</td>
            <td>:</td>
            <td>{{$surat->lampiran}}</td>
        </tr>
        <tr>
            <td>Hal</td>
            <td>:</td>
            <td>{{$surat->perihal}}</td>
        </tr>
    </table>
    @endforeach

    <div class="content3 justifytb" style="margin-left: 120px; margin-right: 70px;">
        <p type="1" style="justify-content: space-between">
            {{$surat->isi_surat}}
            {{-- Sehubungan dengan minimnya persediaan MCCB untuk melayani Pasang Baru dan Perubahan Daya. Dengan ini kami
            moho dibuatkan kontrak sesuai dengan Rincian Material dan Biaya terlampir. Pengadaan MCCB ini bertujuan
            untuk menunjang kelancaran pekerjaan tersebut dengan rincian sebagai berikut: --}}
        </p>

    </div>

    <table class="" width="84%" border="0" cellspacing="0" cellpadding="0" align="right" style="page-break-inside: avoid;">
        @foreach ($nonpos as $nonpo)
        <tr>
            <td style="width: 20%">Nama Pekerjaan</td>
            <td style="width: 1%">:</td>
            <td>{{$nonpo->pekerjaan}}</td>
        </tr>
        <tr>
            <td style="width: 20%">Sumber Dana</td>
            <td style="width: 1%">:</td>
            <td>{{$nonpo->skk_id}}</td>
        </tr>
        <tr>
            <td>PRK</td>
            <td>:</td>
            <td align="left">{{$nonpo->prk_id}}</td>
        </tr>
        <tr>
            <td>Perkiraan Harga</td>
            <td>:</td>
            <td align="left"><b>@currency($nonpo->total_harga_hpe),-</b> <span>({{ Terbilang::make($nonpo->total_harga_hpe, ' rupiah') }})</span> </td>
        </tr>
        <tr>
            <td>Waktu Pelaksanaan</td>
            <td>:</td>
            <td align="left">{{$days}} <span>({{ Terbilang::make($days, ' hari') }})</span></td>
        </tr>
        <tr>
            <td style="height: 15px">
        </tr>
        <tr>
            <td colspan="3">Demikian disampaikan untuk diproses sesuai dengan ketentuan yang berlaku, terima kasih
            </td>
        </tr>
        <tr>
            @if (count($tembusans) > 0)
            <td valign="bottom" align="left">Tembusan :</td>
            @else
            <td valign="bottom" align="left"></td>
            @endif
            <td colspan="2" valign="bottom" align="center" style="height: 140px; padding-left: 100px">{{$surat->nama_pengirim}}</td>
        </tr>
        @if (count($tembusans) > 0)
        @foreach ($tembusans as $tembusan)
        <tr>
            <td colspan="3">- {{$tembusan->isi_tembusan}}</td>
        </tr>
        @endforeach
        @endif



        @endforeach

    </table>


</body>

</html>

@extends('layouts.main')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/po-khs">{{ $active }}</a></li>
            <li class="breadcrumb-item active"><a href=""> {{ $active1 }}</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-dua">
                    <div class="card-header">
                        <h4 class="card-title">Form step {{ $active }}</h4>
                    </div>
                    <div class="m-auto" style="width:97%;">
                        <div id="smartwizard" dir="rtl-" class="mt-4">
                            <ul class="nav nav-progress">
                                <li class="nav-item">
                                    <a class="nav-link" href="#spbj">
                                        <div class="num">1</div>
                                        SPBJ
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#paket_rab">
                                        <span class="num">2</span>
                                        Paket RAB
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#daftar_rab">
                                        <span class="num">3</span>
                                        Daftar RAB
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#redaksi">
                                        <span class="num">4</span>
                                        Redaksi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#isi_kontrak">
                                        <span class="num">5</span>
                                        Review PO
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content mt-3 tab-flex"
                                style="height: auto !important; display: flex !important; flex-direction: column !important;">
                                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                                <div id="spbj" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                    <form id="form-1" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                        <div class="row m-auto">
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label for="first-name" class="form-label">No. Purchase
                                                        Order(PO)</label>
                                                    <input type="text" class="form-control" id="po" name="po"
                                                        value="{{ old('po') }}" placeholder="No. PO" required autofocus>
                                                    <div class="valid-feedback">
                                                        Data Terisi
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Silakan Isi No. PO
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label for="first-name" class="form-label">Pilih No. Kontrak
                                                        Induk</label>
                                                    <select class="form-control input-default" id="kontrak_induk"
                                                        name="kontrak_induk"
                                                        style="height: 60px !important ; word-wrap: normal !important; white-space: normal; overflow: hidden;   text-overflow: ellipsis;"
                                                        required onchange="ganti_item()">
                                                        <option selected disabled value="">Pilih No. Kontrak Induk
                                                        </option>
                                                        @foreach ($kontraks as $kontrak)
                                                            <option value="{{ $kontrak->id }}">
                                                                {{ $kontrak->khs->jenis_khs }} -
                                                                {{ $kontrak->nomor_kontrak_induk }} -
                                                                {{ $kontrak->vendors->nama_vendor }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="valid-feedback">
                                                        Data Terpilih
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Silakan Pilih No. Kontrak Induk
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Judul Pekerjaan</label>
                                                    <textarea type="text" class="form-control @error('pekerjaan') is-invalid @enderror" name="pekerjaan" id="pekerjaan"
                                                        placeholder="Pekerjaan" required>{{ old('pekerjaan') }}</textarea>
                                                    <div class="valid-feedback">
                                                        Data Terisi
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Silakan isi Judul Pekerjaan
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Pilih Direksi Pekerjaan</label>
                                                    <select class="form-control input-default" id="pejabat" name="pejabat"
                                                        style="height: 60px !important ; word-wrap: normal !important; white-space: normal; overflow: hidden;   text-overflow: ellipsis;"
                                                        required>
                                                        <option value="" selected disabled>Direksi Pekerjaan
                                                        </option>
                                                        @foreach ($pejabats as $pejabat)
                                                            @if ($pejabat->jabatan != 'MANAGER UP3')
                                                                <option value="{{ $pejabat->id }}">
                                                                    {{ $pejabat->jabatan }} -
                                                                    {{ $pejabat->nama_pejabat }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <div class="valid-feedback">
                                                        Data Terpilih
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Silakan Pilih Direksi
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Start Date</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="bi bi-calendar2-minus"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" name="start_date" id="start_date"
                                                            class="form-control datepicker-default2"required
                                                            placeholder="Start Date PO-KHS"
                                                            style="border-radius: 0 20px 20px 0">
                                                        <div class="valid-feedback">
                                                            Data Terisi
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Silakan Atur Jadwal Start Date
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">End Date</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="bi bi-calendar2-minus"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" name="end_date" id="end_date"
                                                            class="form-control datepicker-default2"
                                                            placeholder="End Date PO-KHS" readonly="false" required
                                                            autofocus style="border-radius: 0 20px 20px 0">
                                                        <div class="valid-feedback">
                                                            Data Terisi
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Silakan Atur Jadwal End Date
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">No. Addendum</label>
                                                    <input type="text" class="form-control" name="addendum"
                                                        id="addendum" placeholder="No. Addendum Belum Ada" required
                                                        disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Nama Vendor</label>
                                                    <input type="text" class="form-control" name="vendor"
                                                        id="vendor" placeholder="Nama Vendor" required disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Input No.SKK</label>
                                                    <select class="form-control input-default" id="skk_id"
                                                        name="skk_id" required>
                                                        <option value="" selected disabled>Pilih No. SKK</option>
                                                        @foreach ($skks as $skk)
                                                            <option value="{{ $skk->id }}">{{ $skk->nomor_skk }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="valid-feedback">
                                                        Data Terpilih
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Silakan Pilih No. SKK
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Input No. PRK</label>
                                                    <select class="form-control input-default" id="prk_id"
                                                        name="prk_id" required>
                                                        <option value="" selected disabled>Pilih PRK</option>
                                                    </select>
                                                    <div class="valid-feedback">
                                                        Data Terpilih
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Silakan Pilih No. PRK
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Input Pengawas Pekerjaan</label>
                                                    <input type="text"
                                                        class="form-control @error('pengawas') is-invalid @enderror"
                                                        name="pengawas_pekerjaan" id="pengawas_pekerjaan"
                                                        placeholder="Pengawas Pekerjaan" required autofocus
                                                        value="{{ old('pengawas_pekerjaan') }}">
                                                    <div class="valid-feedback">
                                                        Data Terisi
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Silakan isi Pengawas Pekerjaan
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Input Pengawas Lapangan</label>
                                                    <input type="text" class="form-control" name="pengawas_lapangan"
                                                        id="pengawas_lapangan" placeholder="Pengawas Lapangan" autofocus
                                                        value="{{ old('pengawas_lapangan') }}">
                                                    <div class="valid-feedback">
                                                        Data Boleh Kosong
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Upload Lampiran</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Upload</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input id="lampiran" type="file" name="lampiran"
                                                                class="form-control custom-file-input"
                                                                onchange="previewImage()" />
                                                            <label class="custom-file-label">Choose or Drag file</label>
                                                        </div>
                                                    </div>
                                                    <img class="m-auto justify-content-center" src="#"
                                                        id="img-lampiran" width="300px" />
                                                    <div class="valid-feedback">
                                                        Data Terisi
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Silakan Upload Lampiran
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Input Lokasi</label>
                                            </div>
                                        </div>
                                        <table class="table table-responsive-sm height-100" width="100%"
                                            id="tabelSPBJ">
                                            <tr align="center" valign="middle" class="">
                                                <th style="width:5%;" align="center" valign="middle">No.</th>
                                                <th align="center" valign="middle">Lokasi</th>
                                                <th style="width:10%;" align="center" valign="middle">Aksi</th>
                                            </tr>
                                            <tr>
                                                <td><strong id="nomor" value="1">1</strong></td>
                                                <td>
                                                    <textarea type="text" class="form-control lokasi" id="lokasi[1]" name="lokasi" placeholder="Lokasi" required
                                                        onblur="blur_lokasi(this)">{{ old('lokasi') }}</textarea>
                                                </td>
                                                <td><button onclick="deleteRow2(this)"
                                                        class="btn btn-danger shadow btn-xs sharp"><i
                                                            class='fa fa-trash'></i></button></td>
                                            </tr>
                                        </table>
                                        <div class="col-lg-12 mb-2">
                                            <div class="position-relative justify-content-center float-center">
                                                <a type="button" id="tambah-pekerjaan"
                                                    class="btn btn-primary position-relative justify-content-end"
                                                    onclick="updatelokasi()" required>Tambah</a>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <div id="paket_rab" class="tab-pane" role="tabpanel" aria-labelledby="step-2"
                                    style="height: auto !important; display: flex !important; flex-direction: column !important;">
                                    <form id="form-2" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                        <div class="row">
                                            <div class="col-xl-12 col-xxl-12">
                                                <div class="card">
                                                    <div class="card-header justify-content-center">
                                                        <h4 class="card-title">Paket RAB (Opsional)</h4>
                                                    </div>

                                                    <div class="row ml-2">
                                                        <div class="table-responsive" id="tambah_tabel">

                                                            <table class="table table-responsive-sm height-100"
                                                                id="tabelPaket">
                                                                <thead>
                                                                    <tr align="center" valign="middle" class="">
                                                                        <th align="center" valign="middle"
                                                                            style="width: 10px;">No.</th>
                                                                        <th align="center" valign="middle"
                                                                            style="width: 35%;">Lokasi</th>
                                                                        <th align="center" valign="middle">Paket Pekerjaan
                                                                        </th>
                                                                        <th align="center" valign="middle"
                                                                            style="width: 15%">Volume
                                                                        </th>
                                                                        <th align="center" valign="middle"
                                                                            style="width: 5%">Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tbody-paket">
                                                                    {{-- <tr>
                                                                        <td>
                                                                            <select class="select-search form-control input-default" id="pejabat" name="pejabat"
                                                                                style="height: 60px !important ; word-wrap: normal !important; white-space: normal; overflow: hidden;   text-overflow: ellipsis;"
                                                                                required>
                                                                                <option value="" selected disabled>Direksi Pekerjaan
                                                                                </option>
                                                                                @foreach ($pejabats as $pejabat)
                                                                                    @if ($pejabat->jabatan != 'MANAGER UP3')
                                                                                        <option value="{{ $pejabat->id }}">
                                                                                            {{ $pejabat->jabatan }} -
                                                                                            {{ $pejabat->nama_pejabat }}
                                                                                        </option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                        </td>
                                                                    </tr> --}}
                                                                </tbody>
                                                            </table>
                                                            <div class="col-lg-12 mb-2">
                                                                <div
                                                                    class="position-relative justify-content-end float-left">
                                                                    <a type="button" id="tambah-pekerjaan"
                                                                        class="btn btn-primary position-relative justify-content-end"
                                                                        onclick="updatePaket()" required>Tambah</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="daftar_rab" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                    <form id="form-3" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                        <div class="row">
                                            <div class="col-xl-12 col-xxl-12">
                                                <div class="card">
                                                    <div class="card-header justify-content-center">
                                                        <h4 class="card-title">Daftar RAB</h4>
                                                    </div>
                                                    <div class="card-header justify-content-start">
                                                        <h5 id="pagu_prk" class="card-title" style="font-size: 14px;">
                                                        </h5>
                                                    </div>
                                                    <div class="row ml-2">
                                                        <div class="table-responsive" id="tambah_tabel">
                                                            <div id="thead_RAB">
                                                                <table class="table table-responsive-lg tabel-daftar1"
                                                                    style="width: 1530px" cellpadding="0" cellspacing="0">
                                                                    <thead>
                                                                        <tr align="center" valign="middle"
                                                                            class="">
                                                                            <th align="center" valign="middle"
                                                                                style="width: 50px vertical-align: middle;">N O</th>
                                                                            <th align="center" valign="middle"
                                                                                style="width: 350px; vertical-align: middle;">Pekerjaan</th>
                                                                            <th align="center" valign="middle"
                                                                                style="width: 200px; vertical-align: middle;">Kategori
                                                                                Pekerjaan</th>
                                                                            <th align="center" valign="middle"
                                                                                style="width: 130px; vertical-align: middle;">
                                                                                Satuan</th>
                                                                            <th align="center" style="width: 130px; vertical-align: middle;"
                                                                                valign="middle">
                                                                                Volume</th>
                                                                            <th align="center" valign="middle"
                                                                                style="width: 200px; vertical-align: middle;">
                                                                                Harga Satuan
                                                                                (Rp.)
                                                                            </th>
                                                                            <th align="center" valign="middle"
                                                                                style="width: 250px; vertical-align: middle;">
                                                                                Jumlah (Rp.)
                                                                            </th>
                                                                            <th align="center" valign="middle"
                                                                                style="width: 150px; vertical-align: middle;">TKDN
                                                                                (%)
                                                                            </th>
                                                                            <th align="center" valign="middle"
                                                                                style="width: 100px; vertical-align: middle;">
                                                                                Aksi</th>
                                                                        </tr>
                                                                    </thead>
                                                                </table>
                                                            </div>
                                                            <div class="table-resposive" id="tbody_RAB">
                                                                {{-- <label style="font-weight: bold; color:rgb(38, 13, 93)">Nama Lokasi</label> --}}
                                                                <table class="table table-responsive-lg tabel-daftar"
                                                                    style="width: 1530px" id="tabelRAB" cellpadding="0" cellspacing="0">
                                                                    <!-- <caption style="caption-side:top; text-align:middle;">Lokasi : PLN ULP Panakukkang</caption>
                                                                        <caption style="caption-side:top; text-align:middle;">Paket : Besi Timah 12 Gram</caption> -->
                                                                    <thead>
                                                                        <th style="width: 50px"></th>
                                                                        <th style="width: 350px"></th>
                                                                        <th style="width: 200px"></th>
                                                                        <th style="width: 130px"></th>
                                                                        <th style="width: 130px"></th>
                                                                        <th style="width: 200px"></th>
                                                                        <th style="width: 250px"></th>
                                                                        <th style="width: 150px"></th>
                                                                        <th style="width: 100px"></th>
                                                                    </thead>
                                                                    <tbody id="tbody-kategori">
                                                                        <tr>
                                                                            <td><strong id="nomor"
                                                                                    value="1">1</strong></td>

                                                                            <td>
                                                                                <select required
                                                                                    onchange="change_item(this)"
                                                                                    name="item_id" id="item_id[1]"
                                                                                    class="single-select form-control input-default"
                                                                                    style="border-radius: 40px;">
                                                                                    <option value="" selected
                                                                                        disabled required>Pilih Pekerjaan
                                                                                    </option>
                                                                                </select>
                                                                            </td>

                                                                            <td><input type="text"
                                                                                    class="form-control kategory_id"
                                                                                    id="kategory_id[1]" name="kategory_id"
                                                                                    placeholder="Kategori" value=""
                                                                                    disabled readonly required></td>
                                                                            <td><input type="text"
                                                                                    class="form-control satuan"
                                                                                    id="satuan[1]" name="satuan"
                                                                                    placeholder="Satuan" value=""
                                                                                    disabled readonly required>
                                                                            </td>
                                                                            <td><input type="text"
                                                                                    class="form-control volume"
                                                                                    id="volume[1]" name="volume"
                                                                                    placeholder="volume" value=""
                                                                                    onblur="blur_volume(this)"onkeypress="return numbersonly2(this, event);"
                                                                                    onkeyup="format(this)" required></td>
                                                                            <td><input type="text"
                                                                                    class="form-control harga_satuan"
                                                                                    id="harga_satuan[1]"
                                                                                    name="harga_satuan"
                                                                                    placeholder="Harga Satuan"
                                                                                    value="" disabled readonly
                                                                                    required></td>
                                                                            <td><input type="text"
                                                                                    class="form-control harga"
                                                                                    id="harga[1]" name="harga"
                                                                                    placeholder="Jumlah" value=""
                                                                                    disabled readonly required>
                                                                            </td>
                                                                            <td><input type="text"
                                                                                    class="form-control tkdn"
                                                                                    id="tkdn[1]" name="tkdn"
                                                                                    placeholder="TKDN"
                                                                                    onkeyup="tkdn_format(this)"
                                                                                    value="">
                                                                            </td>
                                                                            <td align="center" valign="middle"
                                                                                style="vertical-align: middle; align: middle;"><button
                                                                                    onclick="deleteRow(this)"
                                                                                    class="btn btn-danger shadow btn-xs sharp"><i
                                                                                        class='fa fa-trash'></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                                <div class="col-lg-12 mb-2">
                                                                    <div
                                                                        class="position-relative justify-content-end float-left">
                                                                        <a type="button" id="tambah-pekerjaan"
                                                                            class="btn btn-primary position-relative justify-content-end"
                                                                            onclick="updateform()" required>Tambah</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="table-responsive" id="tfoot_RAB">
                                                                <table class="table table-responsive-sm height-100"
                                                                    id="tabelRAB1">
                                                                    <thead>
                                                                        <tr>
                                                                            <th></th>
                                                                            <th></th>
                                                                            <th></th>
                                                                            <th></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <th style="width: 15%; padding-left: 25px">
                                                                                Jumlah</th>
                                                                            <th style="width: 1%">:</th>
                                                                            <th style="width: 55%" id="jumlah"></th>
                                                                            <th style="width: 29%"></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th style="padding-left: 25px">PPN</th>
                                                                            <th>:</th>
                                                                            <th id="pajak"></th>
                                                                            <th></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th style="padding-left: 25px">Total Harga</th>
                                                                            <th>:</th>
                                                                            <th id="total"></th>
                                                                            <th></th>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="redaksi" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                                    <form id="form-4" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                        <div class="row">
                                            <div class="col-xl-12 col-xxl-12">
                                                <div class="card">
                                                    <div class="card-header justify-content-center">
                                                        <h4 class="card-title">Redaksi</h4>
                                                    </div>
                                                    <div class="row ml-2">
                                                        <div class="table-responsive">
                                                            <table class="table table-responsive-sm height-100"
                                                                id="tabelRedaksi">
                                                                <thead>
                                                                    <tr align="center" valign="middle" class="">
                                                                        <th>No.</th>
                                                                        <th>Redaksi</th>
                                                                        <th>Deskripsi</th>
                                                                        <th>Sub Deskripsi</th>
                                                                        <th>Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tbody-redaksi"
                                                                    style="vertical-align: top !important;">
                                                                    <tr>
                                                                        <td style="vertical-align: top !important;"><strong
                                                                                id="nomor1" value="1">1</strong>
                                                                        </td>
                                                                        <td valign="top"
                                                                            style="vertical-align: top !important;"><select
                                                                                name="redaksi_id" id="redaksi_id[1]"
                                                                                class="form-control input-default"
                                                                                onchange="change_redaksi(this)"
                                                                                style="height: 60px !important; width: 200px !important ; word-wrap: normal !important; white-space: normal; overflow: hidden;   text-overflow: ellipsis;"
                                                                                required>
                                                                                <option value="" selected disabled
                                                                                    required>Pilih Redaksi</option>
                                                                                @foreach ($redaksis as $redaksi)
                                                                                    <option value="{{ $redaksi->id }}">
                                                                                        {{ $redaksi->nama_redaksi }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select></td>
                                                                        <td
                                                                            style="vertical-align: top; text-align: justify;">
                                                                            <p id="deskripsi_id[1]" name="deskripsi_id">
                                                                            </p>
                                                                        </td>
                                                                        <!-- <td>
                                                                                    <textarea type="text" class="form-control deskripsi_id" id="deskripsi_id[1]" name="deskripsi_id"
                                                                                        placeholder="Deskripsi" value="" disabled required></textarea>
                                                                                </td> -->
                                                                        <td style="vertical-align: top">
                                                                            <!-- <p id="sub_deskripsi_id[1]"></p> -->
                                                                            <ol id="sub_deskripsi_id[1]">
                                                                            </ol>
                                                                        </td>
                                                                        <!-- <td>
                                                                                    <textarea type="text" class="form-control deskripsi_id" id="sub_deskripsi_id[1]" name="sub_deskripsi_id"
                                                                                        placeholder="Sub Deskripsi" value="" disabled required></textarea>
                                                                                </td> -->

                                                                        <td style="vertical-align: top"><button
                                                                                onclick="deleteRow1(this)"
                                                                                class="btn btn-danger shadow btn-xs sharp"><i
                                                                                    class='fa fa-trash'></i></button></td>
                                                                    </tr>
                                                                </tbody>

                                                            </table>
                                                            <div class="col-lg-12 mb-2">
                                                                <div
                                                                    class="position-relative justify-content-end float-left">
                                                                    <a type="button" id="tambah-pekerjaan"
                                                                        class="btn btn-primary position-relative justify-content-end"
                                                                        onclick="updateRedaksi()">Tambah</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="isi_kontrak" class="tab-pane" role="tabpanel" aria-labelledby="step-5">
                                    <form id="form-5" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                        <div class="row">
                                            <div class="col-xl-12 col-xxl-12">
                                                <div class="card">
                                                    <div class="card-header justify-content-center">
                                                        <h4 class="card-title">Review Hasil Isi Kontrak</h4>
                                                    </div>
                                                    <div class="row ml-2 justify-content-start">
                                                        <h5 class="card-title">Step 1: Informasi Umum</h5>
                                                        <table id="table_step1" class="uprightTbl noborder"
                                                            style="width:100%;" id="rincian" cellspacing="3"
                                                            cellpadding="3">
                                                            <tr class="noborder">
                                                                <td style="width:20%;">No. Purchase Order
                                                                </td>
                                                                <td style="width:1%">:</td>
                                                                <td style="width:84%" id="po_4">
                                                                </td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>No. Kontrak Induk</td>
                                                                <td>:</td>
                                                                <td id="kontrak_induk_4"></td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>Judul Pekerjaan</td>
                                                                <td>:</td>
                                                                <td id="judul_pekerjaan_4"></td>
                                                            </tr>
                                                            <tr id="tr_lokasi1" class="noborder">
                                                                <td>Lokasi</td>
                                                                <td>:</td>
                                                                <td id="lokasi_4">
                                                                </td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>Start Date</td>
                                                                <td>:</td>
                                                                <td id="start_date_4"></td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>End Date</td>
                                                                <td>:</td>
                                                                <td id="end_date_4"></td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>No. Addendum</td>
                                                                <td>:</td>
                                                                <td id="addendum_4"></td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>No. SKK</td>
                                                                <td>:</td>
                                                                <td id="no_skk_4"></td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>No. PRK</td>
                                                                <td>:</td>
                                                                <td id="no_prk_4"></td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>Direksi Pekerjaan</td>
                                                                <td>:</td>
                                                                <td id="direksi_pekerjaan_4"></td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>Pengawas Pekerjaan</td>
                                                                <td>:</td>
                                                                <td id="pengawas_pekerjaan_4"></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <hr>
                                                    <div class="row ml-2 justify-content-start">
                                                        <h5 class="card-title">Step 3: Daftar RAB</h5>
                                                        <div class="col-xl-12 col-xxl-12">
                                                            <div class="table-responsive">
                                                                <div class="wrapword" id="firstTable">
                                                                    <table id="daftar_rabs" class="" width="100%"
                                                                        border="2" cellspacing="0" cellpadding="0"
                                                                        style="font-size: 12px;">
                                                                        <thead>
                                                                            <tr class="warna">
                                                                                <td style="width:4%;" rowspan="3"
                                                                                    align="center" valign="middle">No</td>
                                                                                <td rowspan="3" align="center"
                                                                                    valign="middle">Uraian Pekerjaan</td>
                                                                                <td style="width:11%;" rowspan="3"
                                                                                    align="center" valign="middle">Satuan
                                                                                </td>
                                                                                <td style="width:9%;" rowspan="3"
                                                                                    align="center" valign="middle">Volume
                                                                                </td>
                                                                                <td style="width:25%;" colspan="2"
                                                                                    align="center" valign="middle">Harga
                                                                                </td>
                                                                            </tr>

                                                                            <tr class="warna first4">
                                                                                <td style="width:11%;" align="center"
                                                                                    valign="middle">Satuan</td>
                                                                                <td style="width:11%;" align="center"
                                                                                    valign="middle">Jumlah</td>
                                                                            </tr>
                                                                            <tr class="warna first3">
                                                                                <td align="center" valign="middle">(RP)
                                                                                </td>
                                                                                <td align="center" valign="middle">(RP)
                                                                                </td>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="tbody_jasa">
                                                                        </tbody>
                                                                        <tbody id="tbody_material">
                                                                        </tbody>
                                                                        <tfoot>
                                                                            <tr>
                                                                                <td rowspan="3" colspan="3"></td>
                                                                                <td colspan="2" align="center"
                                                                                    valign="middle"><b>Jumlah</b></td>
                                                                                <td class="tabellkanan" id="td_jumlah"
                                                                                    style="font-weight: bold"
                                                                                    align="right"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="2" align="center"
                                                                                    valign="middle"><b>PPN 11%</b></td>
                                                                                <td class="tabellkanan" id="td_ppn"
                                                                                    style="font-weight: bold"
                                                                                    align="right"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="2" align="center"
                                                                                    valign="middle"><b>TOTAL</b></td>
                                                                                <td class="tabellkanan" id="td_total"
                                                                                    style="font-weight: bold"
                                                                                    align="right"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="first1"></td>
                                                                                <td class="first2" rowspan="2"
                                                                                    colspan="5" id="terbilang"
                                                                                    style="font-weight: bold; font-style:italic;">
                                                                                </td>
                                                                            </tr>
                                                                        </tfoot>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row ml-2 justify-content-start">
                                                        <h5 class="card-title">Step 3: Redaksi</h5>
                                                        <div class="col-xl-12 col-xxl-12">
                                                            <div class="wrapword" id="firstTable">
                                                                <table width="100%" border="2" cellspacing="0"
                                                                    cellpadding="1" style="font-size: 12px;">
                                                                    <thead align="center" valign="middle">
                                                                        <tr class="warna">
                                                                            <th style="width:4%;" align="center"
                                                                                valign="middle">No</th>
                                                                            <th style="width:25%;" align="center"
                                                                                valign="middle">Redaksi</th>
                                                                            <th align="center" valign="middle">Deskripsi
                                                                            </th>
                                                                            <th align="center" valign="middle">Sub
                                                                                Deskripsi
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tbody_redaksi">
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirm Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Order Placed</h5>
                    <button type="button" class="btn-close" style="border: none; background-color: #fff;"
                        data-bs-dismiss="modal" aria-label="Close"> &#10006; </button>
                </div>
                <div class="modal-body">
                    Congratulations! Your order is placed.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="closeModal()">Ok, close and
                        reset</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <!-- Bootrap for the demo page -->



    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <!-- jQuery Slim 3.6  -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
        integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script> -->

    <!-- Include SmartWizard JavaScript source -->
    {{-- <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/jquery.smartWizard.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/wizard.js"></script> --}}
    {{-- <script src="{{ asset('/') }}./asset/frontend/vendor/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/js/plugins-init/select2-init.js"></script> --}}


    <!-- Search and Select -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
                                    integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" /> -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
            <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> --}}




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/buat_po/searching_select.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/buat_po/smartwizard.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/buat_po/jquery_buat_po_khs.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/buat_po/step2_paket.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/buat_po/step3_rab.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/buat_po/step4_redaksi.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/buat_po/pemisah_titik.js"></script>

    <!-- Required vendors -->
    <script src="{{ asset('/') }}./asset/frontend/vendor/global/global.min.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/js/custom.min.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/js/deznav-init.js"></script>

    <script>



    function myFunction() {
        $("#dropdown-values").addClass("show");
        }

        $(document).click(function(e) {
        if( e.target.id != 'myInput') {
            $("#dropdown-values").removeClass("show");
        }
        });

        function filterFunction() {
        var input, filter, a, i;
        filter = $("#myInput").val().toUpperCase();
        div = document.getElementById("myDropdown");
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            txtValue = a[i].textContent || a[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
            } else {
            a[i].style.display = "none";
            }
        }
        }

        function setValueOfInput(e) {
            $("#myInput").val(e.innerHTML);
        }


        function previewImage() {
            const image = document.querySelector('#lampiran');
            const imgPreview = document.querySelector('#img-lampiran');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
<script>
//     new TomSelect("#tabelPaket tr td:nth-child(3) select",{
//     create: false,
//     sortField: {
//         field: "text",
//         direction: "asc"
//     }
// });

</script>
@endsection



<!-- <script type="text/javascript">
    window.onload = function() {
        window.location.href = "http://127.0.0.1:8000/po-khs/buat-po#spbj"
    }
</script> -->

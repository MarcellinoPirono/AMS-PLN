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
                                    <a class="nav-link" href="#informasi_umum">
                                        <div class="num">1</div>
                                        Informasi Umum
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#menu_paket_pekerjaan">
                                        <span class="num">2</span>
                                        Pilih Paket Pekerjaan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#daftar_rab">
                                        <span class="num">3</span>
                                        Buat RAB
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#redaksi">
                                        <span class="num">4</span>
                                        Redaksi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#isi_kontrak">
                                        <span class="num">5</span>
                                        Review PO-KHS
                                    </a>
                                </li>

                            </ul>

                            <div class="tab-content mt-3 tab-flex">
                                <div id="informasi_umum" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
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
                                                        name="kontrak_induk" required onchange="ganti_item()">
                                                        <option selected disabled value="">Pilih No. Kontrak Induk
                                                        </option>
                                                        @foreach ($kontraks as $kontrak)
                                                            <option value="{{ $kontrak->id }}">
                                                                {{ $kontrak->khs->jenis_khs }} -
                                                                {{ $kontrak->nomor_kontrak_induk }} ({{$kontrak->vendors->nama_vendor}})</option>
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
                                                    <label class="text-label">Nama Vendor</label>
                                                    <input type="text"
                                                        class="form-control @error('vendor') is-invalid @enderror"
                                                        name="vendor" id="vendor"
                                                        placeholder="Nama Vendor" required autofocus
                                                        value="{{ old('vendor') }}">
                                                    <div class="valid-feedback">
                                                        Data Terisi
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Silakan isi Nama Vendor
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
                                                    <label class="text-label">Pilih Direksi Pekerjaan</label>
                                                    <select class="form-control input-default" id="pejabat"
                                                        name="pejabat" style="height: 60px !important ; word-wrap: normal !important; white-space: normal; overflow: hidden;   text-overflow: ellipsis;" required>
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
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Input Lokasi</label>
                                            </div>
                                        </div>
                                        <table class="table table-responsive-sm height-100" width="100%"
                                            id="tabelSPBJ">
                                            <tr align="center" valign="middle" class="">
                                                <th style="width:4%;" align="center" valign="middle">No.</th>
                                                <th align="center" valign="middle">Lokasi</th>
                                                <th style="width:10%;" align="center" valign="middle">Aksi</th>
                                            </tr>
                                            <tr>
                                                <td><strong id="nomor" value="1">1</strong></td>
                                                <td>
                                                    <textarea type="text" class="form-control lokasi" id="lokasi[1]" name="lokasi" placeholder="Lokasi" required>{{ old('lokasi') }}</textarea>
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
                                                    onclick="updatelokasi()" required>Tambah Lokasi</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="menu_paket_pekerjaan" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                <form id="form-2" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                    <div class="row">
                                        <div class="col-xl-12 col-xxl-12">
                                            <div class="card">
                                                <div class="card-header justify-content-center">
                                                    <h4 class="card-title">Pilih Paket Pekerjaan</h4>
                                                </div>
                                                <div class="row ml-2">
                                                    <div class="table-responsive">
                                                        <table class="table table-responsive-sm height-100"
                                                            id="tabelPaket">
                                                            <thead>
                                                                <tr align="center" valign="middle" class="">
                                                                    <th>No.</th>
                                                                    <th>Lokasi</th>
                                                                    <th>Paket Pekerjaan</th>
                                                                    <th>Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbody-paket-pekerjaan">
                                                                <tr>
                                                                    <td><strong id="nomor1"
                                                                            value="1">1</strong></td>
                                                                    <td><select name="lokasi_id" id="lokasi_id[1]"
                                                                            class="form-control input-default"
                                                                            onchange="change_redaksi(this)" required>
                                                                            <option value="" selected disabled
                                                                                required >Pilih Lokasi</option>
                                                                            @foreach ($redaksis as $redaksi)
                                                                                <option value="{{ $redaksi->id }}">
                                                                                    {{ $redaksi->nama_redaksi }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>

                                                                    <td><select name="paket_pekerjaan" id="paket_pekerjaan[1]"
                                                                        class="form-control input-default" style="width: 50px !important ; word-wrap: normal !important; white-space: normal; overflow: hidden;   text-overflow: ellipsis;"
                                                                        onchange="change_redaksi(this)" required>
                                                                        <option value="" selected disabled
                                                                            required >Pilih Paket Pekerjaan</option>
                                                                        @foreach ($redaksis as $redaksi)
                                                                            <option value="{{ $redaksi->id }}">
                                                                                {{ $redaksi->nama_redaksi }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>




                                                                    <td><button onclick="deleteRow2(t his)"
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
                                                                    onclick="updatePaket()">Tambah Paket</a>
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
                                                    <div class="table-responsive">
                                                        <table class="table table-responsive-sm height-100"
                                                            id="tabelRAB">
                                                            <thead>
                                                                <tr align="center" valign="middle" class="">
                                                                    <th align="center" valign="middle"
                                                                        style="width: 4px;">No</th>
                                                                    <th align="center" valign="middle">Pekerjaan</th>
                                                                    <th align="center" valign="middle">Kategori
                                                                        Pekerjaan</th>
                                                                    <th align="center" valign="middle">Satuan</th>
                                                                    <th align="center" valign="middle">Volume</th>
                                                                    <th align="center" valign="middle">Harga Satuan
                                                                        (Rp.)
                                                                    </th>
                                                                    <th align="center" valign="middle">Jumlah (Rp.)
                                                                    </th>
                                                                    <th align="center" valign="middle">Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbody-kategori">
                                                                <tr>
                                                                    <td><strong id="nomor"
                                                                            value="1">1</strong></td>
                                                                    <td><select  name="item_id" id="item_id[1]"
                                                                            class="form-control input-default" style="height: 90px !important ; word-wrap: normal !important; white-space: normal; overflow: hidden;   text-overflow: ellipsis;"
                                                                            onchange="change_item(this)" required>
                                                                            <option value="" selected disabled
                                                                                required>Pilih Pekerjaan</option>
                                                                        </select></td>
                                                                    <td><input type="text"
                                                                            class="form-control kategory_id"
                                                                            id="kategory_id[1]" name="kategory_id"
                                                                            placeholder="Kategori" value=""
                                                                            disabled readonly required></td>
                                                                    <td><input type="text"
                                                                            class="form-control satuan" id="satuan[1]"
                                                                            name="satuan" placeholder="Satuan"
                                                                            value="" disabled readonly required>
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control volume" id="volume[1]"
                                                                            name="volume" placeholder="volume"
                                                                            value=""
                                                                            onblur="blur_volume(this)"onkeypress="return numbersonly2(this, event);"
                                                                            onkeyup="format(this)" required></td>
                                                                    <td><input type="text"
                                                                            class="form-control harga_satuan"
                                                                            id="harga_satuan[1]" name="harga_satuan"
                                                                            placeholder="Harga Satuan" value=""
                                                                            disabled readonly required></td>
                                                                    <td><input type="text"
                                                                            class="form-control harga" id="harga[1]"
                                                                            name="harga" placeholder="Jumlah"
                                                                            value="" disabled readonly required>
                                                                    </td>
                                                                    <td><button onclick="deleteRow(this)"
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
                                                                    onclick="updateform()" required>Tambah</a>
                                                            </div>
                                                        </div>
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

                                                                    <th style="width: 55%"> </th>
                                                                    <th style="width: 15%">Jumlah</th>
                                                                    <th style="width: 1%">:</th>
                                                                    <th style="width: 29%" id="jumlah"></th>
                                                                </tr>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>PPN</th>
                                                                    <th>:</th>
                                                                    <th id="pajak"></th>
                                                                </tr>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>Total Harga</th>
                                                                    <th>:</th>
                                                                    <th id="total"></th>
                                                                </tr>

                                                            </tfoot>
                                                        </table>
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
                                                            <tbody id="tbody-redaksi">
                                                                <tr>
                                                                    <td><strong id="nomor1"
                                                                            value="1">1</strong></td>
                                                                    <td><select name="redaksi_id" id="redaksi_id[1]"
                                                                            class="form-control input-default" style="width: 50px !important ; word-wrap: normal !important; white-space: normal; overflow: hidden;   text-overflow: ellipsis;"
                                                                            onchange="change_redaksi(this)" required>
                                                                            <option value="" selected disabled
                                                                                required >Pilih Redaksi</option>
                                                                            @foreach ($redaksis as $redaksi)
                                                                                <option value="{{ $redaksi->id }}">
                                                                                    {{ $redaksi->nama_redaksi }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select></td>
                                                                    <td>
                                                                        <textarea type="text" class="form-control deskripsi_id" id="deskripsi_id[1]" name="deskripsi_id"
                                                                            placeholder="Deskripsi" value="" disabled required></textarea>
                                                                    </td>
                                                                    <td>
                                                                        <textarea type="text" class="form-control deskripsi_id" id="sub_deskripsi_id[1]" name="sub_deskripsi_id"
                                                                            placeholder="Sub Deskripsi Kosong" value="" disabled required></textarea>
                                                                    </td>

                                                                    <td><button onclick="deleteRow1(this)"
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
                                                                    onclick="updateRedaksi()">Tambah Lokasi</a>
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
                                                    <h5 class="card-title">Step 2: Daftar RAB</h5>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- jQuery Slim 3.6  -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
        integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script> -->

    <!-- Include SmartWizard JavaScript source -->
    <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/jquery.smartWizard.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/wizard.js"></script>

    <script type="text/javascript">
        const myModal = new bootstrap.Modal(document.getElementById('confirmModal'));

        function onCancel() {
            // Reset wizard
            $('#smartwizard').smartWizard("reset");

            // Reset form
            document.getElementById("form-1").reset();
            document.getElementById("form-2").reset();
            document.getElementById("form-3").reset();
            document.getElementById("form-4").reset();
            document.getElementById("form-5").reset();
        }

        function onConfirm() {
            let form = document.getElementById('form-4');
            if (form) {
                if (!form.checkValidity()) {
                    form.classList.add('was-validated');
                    $('#smartwizard').smartWizard("setState", [3], 'error');
                    $("#smartwizard").smartWizard('fixHeight');
                    return false;
                }

                $('#smartwizard').smartWizard("unsetState", [3], 'error');
                myModal.show();
            }
        }

        function closeModal() {
            // Reset wizard
            $('#smartwizard').smartWizard("reset");

            // Reset form
            document.getElementById("form-1").reset();
            document.getElementById("form-2").reset();
            document.getElementById("form-3").reset();
            document.getElementById("form-4").reset();
            document.getElementById("form-5").reset();

            myModal.hide();
        }

        function showConfirm() {
            const name = $('#name').val() + ' ' + $('#name').val();
            const products = $('#name').val();
            const shipping = $('#name').val() + ' ' + $('#name').val() + ' ' + $('#name').val();
            let html = `
                  <div class="row">
                    <div class="col">
                      <h4 class="mb-3-">Customer Details</h4>
                      <hr class="my-2">
                      <div class="row g-3 align-items-center">
                        <div class="col-auto">
                          <label class="col-form-label">Name</label>
                        </div>
                        <div class="col-auto">
                          <span class="form-text-">${name}</span>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <h4 class="mt-3-">Shipping</h4>
                      <hr class="my-2">
                      <div class="row g-3 align-items-center">
                        <div class="col-auto">
                          <span class="form-text-">${shipping}</span>
                        </div>
                      </div>
                    </div>
                  </div>


                  <h4 class="mt-3">Products</h4>
                  <hr class="my-2">
                  <div class="row g-3 align-items-center">
                    <div class="col-auto">
                      <span class="form-text-">${products}</span>
                    </div>
                  </div>

                  `;
            $("#order-details").html(html);
            $('#smartwizard').smartWizard("fixHeight");
        }

        $(function() {
            // Leave step event is used for validating the forms
            $("#smartwizard").on("leaveStep", function(e, anchorObject, currentStepIdx, nextStepIdx,
                stepDirection) {
                // Validate only on forward movement
                $('#start_date').removeAttr('readonly');
                $('#end_date').removeAttr('readonly');

                if (stepDirection == 'forward') {
                    let form = document.getElementById('form-' + (currentStepIdx + 1));
                    if (form) {
                        if (!form.checkValidity()) {
                            form.classList.add('was-validated');
                            $('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                            $("#smartwizard").smartWizard('fixHeight');
                            return false;
                        }
                        $('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
                    }
                }
            });

            // Step show event
            $("#smartwizard").on("showStep", function(e, anchorObject, stepIndex, stepDirection, stepPosition) {
                $("#prev-btn").removeClass('disabled').prop('disabled', false);
                $("#next-btn").removeClass('disabled').prop('disabled', false);
                if (stepPosition === 'first') {
                    var new_click = clicklokasi - 1;
                    for (var i = 0; i < new_click; i++) {
                        document.getElementById('location' + (i + 1)).remove();
                    }
                    $("#prev-btn").addClass('disabled').prop('disabled', true);
                } else if (stepPosition === 'last') {
                    var po = $("#po").val();
                    var kontrak_induk = $("#kontrak_induk option:selected").text();
                    var pekerjaan = $("#pekerjaan").val();
                    var start_date = $("#start_date").val();
                    var end_date = $("#end_date").val();
                    var addendum = $("#addendum").val();
                    var skk_id = $("#skk_id option:selected").text();
                    var prk_id = $("#prk_id option:selected").text();
                    var pejabat = $("#pejabat option:selected").text();
                    var pengawas = $("#pengawas_pekerjaan").val();

                    for (var i = 0; i < clicklokasi; i++) {
                        if (i == 0) {
                            var lokasi = document.getElementById('lokasi[' + (i + 1) + ']').value;

                            $("#lokasi_4").html("1. " + lokasi);
                        } else {
                            var lokasi = document.getElementById('lokasi[' + (i + 1) + ']').value;
                            var lokasi_tabel = document.querySelectorAll('#table_step1 tr:nth-child(' + (i +
                                3) + ')');

                            $('<tr id="location' + i + '" class="noborder"><td></td><td></td><td>' + (i +
                                    1) + '. ' + lokasi +
                                '</td></tr>').insertAfter(lokasi_tabel);
                        }
                    }
                    $("#po_4").html(po);
                    $("#kontrak_induk_4").html(kontrak_induk);
                    $("#judul_pekerjaan_4").html(pekerjaan);
                    $("#start_date_4").html(start_date);
                    $("#end_date_4").html(end_date);
                    if (addendum == "") {
                        $("#addendum_4").html("-");
                    } else {
                        $("#addendum_4").html(addendum);
                    }
                    $("#no_skk_4").html(skk_id);
                    $("#no_prk_4").html(prk_id);
                    $("#direksi_pekerjaan_4").html(pejabat);
                    $("#pengawas_pekerjaan_4").html(pengawas);

                    baris = [];
                    baris_jasa = [];
                    baris_material = [];

                    var html_material = [""];

                    for (var i = 0; i < click; i++) {
                        baris[i] = [
                            document.getElementById("item_id[" + (i + 1) + "]").options[document
                                .getElementById("item_id[" + (i + 1) + "]").selectedIndex].text,
                            document.getElementById("kategory_id[" + (i + 1) + "]").value,
                            document.getElementById("satuan[" + (i + 1) + "]").value,
                            document.getElementById("volume[" + (i + 1) + "]").value,
                            document.getElementById("harga_satuan[" + (i + 1) + "]").value,
                            document.getElementById("harga[" + (i + 1) + "]").value
                        ]

                        if (baris[i][1] == "Jasa") {
                            baris_jasa[i] = [baris[i]];
                        } else {
                            baris_material[i] = [baris[i]];
                        }
                    }

                    const result_jasa = baris_jasa.filter(element => {
                        return element !== null;
                    });
                    const result_material = baris_material.filter(element => {
                        return element !== null;
                    });

                    if (result_jasa.length > 0) {
                        var html_jasa = [""]
                        var tbody = document.getElementById("tbody_jasa")
                        var panjang = result_jasa.length
                        for (var j = 0; j < panjang; j++) {
                            html_jasa += ("<tr> <td class='first' align='center' valign='middle'>" + (j +
                                    1) +
                                "</td> <td class='first tabellkiri' align='left' valign='middle'>" +
                                result_jasa[j][0][0] +
                                "</td> <td class='first' align='center' valign='middle'>" + result_jasa[
                                    j][0][2].match(/\(([^)]+)\)/)[1] +
                                "</td> <td class='first' align='center' valign='middle'>" + result_jasa[
                                    j][0][3] +
                                "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                                result_jasa[
                                    j][0][4] +
                                "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                                result_jasa[
                                    j][0][5] + "</td> </tr>")
                        }
                        document.getElementById("tbody_jasa").innerHTML =
                            "<tr> <td class='first' align='center' valign='middle'> </td> <td class='first tabellkiri' align='left' valign='middle' style='font-weight: bold'>JASA:</td> <td class='first' align='center' valign='middle'></td> <td class='first' align='center' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> </tr>" +
                            html_jasa;
                    }

                    if (result_material.length > 0) {
                        var html_material = [""]
                        var tbody = document.getElementById("tbody_material")
                        var panjang = result_material.length
                        for (var j = 0; j < panjang; j++) {
                            html_material += ("<tr> <td class='first' align='center' valign='middle'>" + (
                                    j + 1) +
                                "</td> <td class='first tabellkiri' align='left' valign='middle'>" +
                                result_material[j][0][0] +
                                "</td> <td class='first' align='center' valign='middle'>" +
                                result_material[j][0][2] +
                                "</td> <td class='first' align='center' valign='middle'>" +
                                result_material[j][0][3] +
                                "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                                result_material[j][0][4] +
                                "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                                result_material[j][0][5] + "</td> </tr>")
                        }
                        document.getElementById("tbody_material").innerHTML =
                            "<tr> <td class='first' align='center' valign='middle'> </td> <td class='first tabellkiri' align='left' valign='middle' style='font-weight: bold'>MATERIAL:</td> <td class='first' align='center' valign='middle'></td> <td class='first' align='center' valign='middle'></td> <td class='first' align='right' valign='middle'></td> <td class='first' align='right' valign='middle'></td> </tr>" +
                            html_material;
                    }

                    document.getElementById("td_jumlah").innerHTML = document.getElementById("jumlah")
                        .innerHTML;
                    document.getElementById("td_ppn").innerHTML = document.getElementById("pajak")
                        .innerHTML;
                    document.getElementById("td_total").innerHTML = document.getElementById("total")
                        .innerHTML;

                    function terbilang(angka) {
                        var bilne = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan",
                            "Sembilan", "Sepuluh", "Sebelas"
                        ];

                        if (angka < 12) {
                            return bilne[angka];
                        } else if (angka < 20) {
                            return terbilang(angka - 10) + " Belas";
                        } else if (angka < 100) {
                            return terbilang(Math.floor(parseInt(angka) / 10)) + " Puluh " + terbilang(
                                parseInt(angka) % 10);
                        } else if (angka < 200) {
                            return "Seratus " + terbilang(parseInt(angka) - 100);
                        } else if (angka < 1000) {
                            return terbilang(Math.floor(parseInt(angka) / 100)) + " Ratus " + terbilang(
                                parseInt(angka) % 100);
                        } else if (angka < 2000) {
                            return "Seribu " + terbilang(parseInt(angka) - 1000);
                        } else if (angka < 1000000) {
                            return terbilang(Math.floor(parseInt(angka) / 1000)) + " Ribu " + terbilang(
                                parseInt(angka) % 1000);
                        } else if (angka < 1000000000) {
                            return terbilang(Math.floor(parseInt(angka) / 1000000)) + " Juta " + terbilang(
                                parseInt(angka) % 1000000);
                        } else if (angka < 1000000000000) {
                            return terbilang(Math.floor(parseInt(angka) / 1000000000)) + " Milyar " +
                                terbilang(parseInt(angka) % 1000000000);
                        } else if (angka < 1000000000000000) {
                            return terbilang(Math.floor(parseInt(angka) / 1000000000000)) + " Trilyun " +
                                terbilang(parseInt(angka) % 1000000000000);
                        }
                    }

                    var terbilang1 = document.getElementById("td_total").innerHTML;
                    terbilang1 = terbilang1.replace(/\Rp. /g, "");
                    terbilang1 = terbilang1.replace(/\./g, "");
                    terbilang1 = parseInt(terbilang1);
                    document.getElementById("terbilang").innerHTML = "Terbilang: " + terbilang(terbilang1) +
                        " Rupiah";

                    redaksi_line = [];

                    for (var i = 0; i < clickredaksi; i++) {

                        redaksi_line[i] = [
                            document.getElementById("redaksi_id[" + (i + 1) + "]").options[document
                                .getElementById("redaksi_id[" + (i + 1) + "]").selectedIndex].text,
                            document.getElementById("deskripsi_id[" + (i + 1) + "]").value,
                            document.getElementById("sub_deskripsi_id[" + (i + 1) + "]").value
                        ]

                    }

                    if (redaksi_line.length > 0) {
                        var html_redaksi = [""];
                        var isi_redaksi = redaksi_line.length;
                        for (var j = 0; j < isi_redaksi; j++) {
                            html_redaksi += ("<tr> <td class='first' align='center' valign='top'>" + (j +
                                    1) +
                                "</td> <td class='first tabellkiri tabellkanan' align='left' valign='top'>" +
                                redaksi_line[j][0] +
                                "</td> <td class='first tabellkiri tabellkanan' align='left' valign='top'>" +
                                redaksi_line[
                                    j][1] +
                                "</td> <td class='first tabellkiri tabellkanan' align='left' valign='top'>" +
                                redaksi_line[
                                    j][2] + "</td> </tr>")
                        }
                        document.getElementById("tbody_redaksi").innerHTML = html_redaksi;
                    }
                    $("#next-btn").addClass('disabled').prop('disabled', true);
                } else if (stepPosition === 'second') {
                    var new_click = clicklokasi - 1;
                    for (var i = 0; i < new_click; i++) {
                        document.getElementById('location' + (i + 1)).remove();
                    }
                    // console.log(stepPosition);
                    $("#prev-btn").removeClass('disabled').prop('disabled', false);
                    $("#next-btn").removeClass('disabled').prop('disabled', false);
                } else {
                    var new_click = clicklokasi - 1;
                    for (var i = 0; i < new_click; i++) {
                        document.getElementById('location' + (i + 1)).remove();
                    }
                    $("#prev-btn").removeClass('disabled').prop('disabled', false);
                    $("#next-btn").removeClass('disabled').prop('disabled', false);
                }

                // Get step info from Smart Wizard
                let stepInfo = $('#smartwizard').smartWizard("getStepInfo");
                $("#sw-current-step").text(stepInfo.currentStep + 1);
                $("#sw-total-step").text(stepInfo.totalSteps);

                if (stepPosition == 'last') {
                    showConfirm();
                    $("#btnFinish").prop('disabled', false);
                } else {
                    $("#btnFinish").prop('disabled', true);
                }

                // Focus first name
                if (stepIndex == 1) {
                    setTimeout(() => {
                        $('#first-name').focus();
                    }, 0);
                }
            });

            // Smart Wizard
            $('#smartwizard').smartWizard({
                selected: 0,
                // autoAdjustHeight: false,
                theme: 'arrows', // basic, arrows, square, round, dots
                transition: {
                    animation: 'slideSwing'
                },
                toolbar: {
                    showNextButton: true, // show/hide a Next button
                    showPreviousButton: true, // show/hide a Previous button
                    position: 'bottom', // none/ top/ both bottom
                    extraHtml: `<button class="btn btn-success" id="btnFinish" disabled onclick="onSubmitData()">Complete Order</button>
                              <button class="btn btn-danger" id="btnCancel" onclick="onCancel()">Cancel</button>`
                },
                anchor: {
                    enableNavigation: true, // Enable/Disable anchor navigation
                    enableNavigationAlways: false, // Activates all anchors clickable always
                    enableDoneState: true, // Add done state on visited steps
                    markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                    unDoneOnBackNavigation: true, // While navigate back, done state will be cleared
                    enableDoneStateNavigation: true // Enable/Disable the done state navigation
                },
            });

            $("#state_selector").on("change", function() {
                $('#smartwizard').smartWizard("setState", [$('#step_to_style').val()], $(this).val(), !$(
                    '#is_reset').prop("checked"));
                return true;
            });

            $("#style_selector").on("change", function() {
                $('#smartwizard').smartWizard("setStyle", [$('#step_to_style').val()], $(this).val(), !$(
                    '#is_reset').prop("checked"));
                return true;
            });

        });
    </script>

    <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/buat_po/jquery_buat_po_khs.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/buat_po/step2_paket.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/buat_po/step3_rab.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/buat_po/step4_redaksi.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/buat_po/pemisah_titik.js"></script>


@endsection




{{-- <script type="text/javascript">
    window.onload = function() {
        window.location.href = "http://127.0.0.1:8000/po-khs/buat-po#informasi_umum"
    }
</script> --}}

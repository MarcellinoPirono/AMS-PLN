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
                                                        Order(PO) <span class="text-danger">*</span></label>
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
                                                        Induk <span class="text-danger">*</span></label>
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
                                                    <label class="text-label">Judul Pekerjaan <span class="text-danger">*</span></label>
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
                                                    <label class="text-label">Pilih Direksi Pekerjaan <span class="text-danger">*</span></label>
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
                                                    <label class="text-label">Start Date <span class="text-danger">*</span></label>
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
                                                    <label class="text-label">End Date <span class="text-danger">*</span></label>
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
                                                    <label class="text-label">Input No.SKK <span class="text-danger">*</span></label>
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
                                                    <label class="text-label">Input No. PRK <span class="text-danger">*</span></label>
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
                                                    <label class="text-label">Input Pengawas Pekerjaan <span class="text-danger">*</span></label>
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
                                                    <label class="text-label">Upload Lampiran (.pdf)</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Upload</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input id="lampiran" type="file" name="lampiran"
                                                                class="form-control custom-file-input"
                                                                onchange="fileValidation();" accept=".pdf" />
                                                            <label id="labelfile" class="custom-file-label">Choose or Drag
                                                                file</label>


                                                        </div>
                                                        <!-- <button class="btn btn-danger btn-xxs mt-1 ml-3"
                                                                onclick="onclear()">Delete file <i
                                                                    class='fa fa-trash'></i></button>
                                                            <button class="btn btn-secondary btn-xxs mt-1 ml-3"
                                                                onclick="toggle()" type="button">Show/Hide <i
                                                                    class='fa fa-eye'></i> -->
                                                    </div>
                                                    {{-- <img class="m-auto justify-content-center" src="#"
                                                        id="img-lampiran" width="300px" /> --}}
                                                    <div class="valid-feedback">
                                                        Data Terisi
                                                    </div>
                                                    <div class="invalid-feedback" id="lampiranfile">
                                                        Silakan Upload Lampiran
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2 mt-45">
                                                <div class="form-group">
                                                    <button class="btn btn-danger btn-xxs mt-1"
                                                        onclick="onclear()">Delete file <i
                                                            class='fa fa-trash'></i></button>
                                                    <button class="btn btn-secondary btn-xxs mt-1" onclick="toggle()"
                                                        type="button">Show/Hide <i class='fa fa-eye'></i>
                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-12 mb-2 mt-45">
                                                <div class="form-group">
                                                    <label class="text-label">Upload Lampiran (.pdf)</label>
                                                    <input type="file" class="filepond" height="500" id="lampiran2" data-pdf-preview-height="500" data-pdf-component-extra-params="toolbar=0&navpanes=0&scrollbar=0&view=fitH"/>
                                                    <div class="position-relative justify-content-center float-center">
                                                        <button class="btn btn-danger btn-xxs mt-1"
                                                           id="button-reset">Delete file <i
                                                            class='fa fa-trash'></i></button>
                                                        <button class="btn btn-secondary btn-xxs mt-1 ml-2"
                                                            onclick="toggle('embedLink')" type="button">Show/Hide <i
                                                            class='fa fa-eye'></i>
                                                            <svg
                                                                xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" fill="currentColor" class="bi bi-eye"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                <path
                                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>






                                        <embed style="display:none; overflow-x: visible; overflow-y: visible;"
                                            width="100%" height="650px" name="embedLink" id="embedLink"
                                            type="application/pdf" />

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="text-label">Input Lokasi <span class="text-danger">*</span></label>
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
                                                    class="btn btn-secondary btn-xs position-relative justify-content-end"
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
                                                                        <th align="center" valign="middle"
                                                                            style="width: 40%">Paket Pekerjaan
                                                                        </th>
                                                                        <th align="center" valign="middle"
                                                                            style="width: 15%">Volume
                                                                        </th>
                                                                        <th align="center" valign="middle"
                                                                            style="width: 5%">
                                                                            Aksi</th>
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
                                                                        class="btn btn-secondary btn-xs position-relative justify-content-end"
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
                                        <input type="hidden" name="ppn" id="ppn" value="{{ $ppn[0]->ppn }}">
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
                                                                    style="width: 1520px" cellpadding="0" cellspacing="0"
                                                                    border="0">
                                                                    <thead>
                                                                        <tr align="center" valign="middle">
                                                                            <th align="center" valign="middle"
                                                                                style="width: 60px vertical-align: middle;">
                                                                                NO</th>
                                                                            <th align="center" valign="middle"
                                                                                style="width: 322px; vertical-align: middle;">
                                                                                Pekerjaan</th>
                                                                            <th align="center" valign="middle"
                                                                                style="width: 185px; vertical-align: middle;">
                                                                                Kategori
                                                                                Pekerjaan</th>
                                                                            <th align="center" valign="middle"
                                                                                style="width: 134px; vertical-align: middle;">
                                                                                Satuan</th>
                                                                            <th align="center"
                                                                                style="width: 160px; vertical-align: middle;"
                                                                                valign="middle">
                                                                                Volume</th>
                                                                            <th align="center" valign="middle"
                                                                                style="width: 209px; vertical-align: middle;">
                                                                                Harga Satuan
                                                                                (Rp.)
                                                                            </th>
                                                                            <th align="center" valign="middle"
                                                                                style="width: 230px; vertical-align: middle;">
                                                                                Jumlah (Rp.)
                                                                            </th>
                                                                            <th align="center" valign="middle"
                                                                                style="width: 130px; vertical-align: middle;">
                                                                                TKDN
                                                                                (%)
                                                                            </th>
                                                                            <th align="center" valign="middle"
                                                                                style="width: 80px; vertical-align: middle !important;">
                                                                                Aksi</th>
                                                                        </tr>
                                                                    </thead>
                                                                </table>
                                                            </div>
                                                            <div class="table-resposive" id="tbody_RAB">
                                                                {{-- <label style="font-weight: bold; color:rgb(15, 58, 106)">Nama Lokasi:</label> --}}
                                                                <table class="table table-responsive-lg tabel-daftar"
                                                                    style="width: 1520px" id="tabelRAB" cellpadding="0"
                                                                    cellspacing="0" border="0">
                                                                    <thead>
                                                                        <th style="width: 63px"></th>
                                                                        <th style="width: 300px"></th>
                                                                    </thead>
                                                                    <tbody id="tbody-kategori">
                                                                        <tr>
                                                                            <td><strong style="padding-left: 11px"
                                                                                    id="nomor"
                                                                                    value="1">1</strong>
                                                                            </td>

                                                                            <td>
                                                                                <div class="searching-select2">
                                                                                    <input type="search"
                                                                                        class="form-control input-default"
                                                                                        name="item_id" id="item_id[1]"
                                                                                        placeholder="Pilih Pekerjaan"
                                                                                        onkeyup="filterFunction2(this,event)"
                                                                                        onkeydown="return no_bckspc(this, event)"
                                                                                        {{-- onchange="change_item(this)" --}} required>
                                                                                    <ul id="ul_paket_id2[1]"></ul>
                                                                                </div>
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
                                                                                    value="" required>
                                                                            </td>
                                                                            <td>
                                                                                <button onclick="deleteRow(this)"
                                                                                    class="btn btn-danger shadow btn-xs sharp"
                                                                                    style="margin-top: 15px"><i
                                                                                        class='fa fa-trash'></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                                <div class="col-lg-12 mb-2">
                                                                    <div class="position-relative float-left">
                                                                        <a type="button" id="tambah-pekerjaan"
                                                                            class="btn btn-secondary btn-xs position-relative justify-content-end"
                                                                            onclick="updateform(this)" required>Tambah</a>
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
                                                                            <th style="width: 20%; padding-left: 35px">
                                                                                Jumlah</th>
                                                                            <th style="width: 1%">:</th>
                                                                            <th style="width: 55%" id="jumlah"></th>
                                                                            <th style="width: 24%"></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th style="padding-left: 35px">PPN {{ $ppn[0]->ppn }}%</th>
                                                                            <th>:</th>
                                                                            <th id="pajak"></th>
                                                                            <th></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th style="padding-left: 35px">Total Harga</th>
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
                                                                        <td style="vertical-++++++++++++++++align: top">
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
                                                                        class="btn btn-secondary btn-xs position-relative justify-content-end"
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
                                                            <tr class="noborder">
                                                                <td>Direksi Pekerjaan</td>
                                                                <td>:</td>
                                                                <td id="direksi_pekerjaan_4"></td>
                                                            </tr>
                                                            <tr id="tr_lokasi1" class="noborder">
                                                                <td>Lokasi</td>
                                                                <td>:</td>
                                                                <td id="lokasi_4"></td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>Nama Vendor</td>
                                                                <td>:</td>
                                                                <td id="nama_vendor_4"></td>
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
                                                                <td>Pengawas Pekerjaan</td>
                                                                <td>:</td>
                                                                <td id="pengawas_pekerjaan_4"></td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>Pengawas Lapangan</td>
                                                                <td>:</td>
                                                                <td id="pengawas_lapangan_4"></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <hr>
                                                    <div class="row ml-2 justify-content-start">
                                                        <h5 class="card-title">Step 2 & 3: Daftar RAB</h5>
                                                        {{-- <div class="col-xl-12 col-xxl-12">
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
                                                                        <tbody id="tbody_paket">
                                                                        </tbody>
                                                                        <tfoot>
                                                                            <tr>
                                                                                <td rowspan="3" colspan="3"></td>
                                                                                <td colspan="2" align="center"
                                                                                    valign="middle"><b>Jumlah</b></td>
                                                                                <td class="tabellkanan"
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
                                                        </div> --}}
                                                        <div class="col-xl-12 col-xxl-12">
                                                            <div class="table-responsive">
                                                                <div class="wrapword" id="firstTable">
                                                                    <table id="daftar_rabs" class="" width="100%"
                                                                        border="2" cellspacing="0" cellpadding="0"
                                                                        style="font-size: 11px;">
                                                                        <thead>
                                                                            <tr class="warna">
                                                                                <td style="width:4%;" rowspan="3"
                                                                                    align="center" valign="middle">No</td>
                                                                                <td rowspan="3" align="center"
                                                                                    valign="middle">Uraian</td>
                                                                                <td style="width:5%;" rowspan="3"
                                                                                    align="center" valign="middle">Sat.
                                                                                </td>
                                                                                <td style="width:7%;" rowspan="3"
                                                                                    align="center" valign="middle">Volume
                                                                                </td>
                                                                                <td style="width:20%;" colspan="2"
                                                                                    align="center" valign="middle">Harga
                                                                                </td>
                                                                                <td style="width:5%;" rowspan="3"
                                                                                    align="center" valign="middle">TKDN
                                                                                    (%)
                                                                                </td>
                                                                                <td style="width:21%;" rowspan="2"
                                                                                    colspan="3" align="center"
                                                                                    valign="middle">Biaya TKDN (Rupiah)
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="warna first4">
                                                                                <td style="width:9%;" align="center"
                                                                                    valign="middle">Satuan</td>
                                                                                <td style="width:9%;" align="center"
                                                                                    valign="middle">Jumlah</td>
                                                                            </tr>
                                                                            <tr class="warna first3">
                                                                                <td align="center" valign="middle">(RP)
                                                                                </td>
                                                                                <td align="center" valign="middle">(RP)
                                                                                </td>
                                                                                <td class="warna first35"
                                                                                    style="width:7%;" align="center"
                                                                                    valign="middle">KDN
                                                                                </td>
                                                                                <td class="warna first35"
                                                                                    style="width:7%;" align="center"
                                                                                    valign="middle">KLN
                                                                                </td>
                                                                                <td class="warna first35"
                                                                                    style="width:7%;" align="center"
                                                                                    valign="middle">Total
                                                                                </td>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="tbody_jasa">
                                                                        </tbody>
                                                                        <tbody id="tbody_material">
                                                                        </tbody>
                                                                        <tbody id="tbody_paket">
                                                                        </tbody>
                                                                        <tfoot>
                                                                            <tr style="border: 1px #000">
                                                                                <td rowspan="5" colspan="3"></td>
                                                                                <td colspan="2" align="center"
                                                                                    valign="middle"><b>Jumlah Jasa</b></td>
                                                                                <td class="tabellkanan"
                                                                                    id="jumlah_jasa_count"
                                                                                    style="font-weight: bold"
                                                                                    align="right">
                                                                                </td>
                                                                                <td class="tabellkanan"
                                                                                    id="jumlah_jasa_tkdn"
                                                                                    style="font-weight: bold"
                                                                                    align="center">
                                                                                </td>
                                                                                <td class="tabellkanan"
                                                                                    id="jumlah_kdn_jasa_count"
                                                                                    style="font-weight: bold"
                                                                                    align="right">
                                                                                </td>
                                                                                <td class="tabellkanan"
                                                                                    id="jumlah_kln_jasa_count"
                                                                                    style="font-weight: bold"
                                                                                    align="right">
                                                                                </td>
                                                                                <td class="tabellkanan"
                                                                                    id="jumlah_total_tkdn_jasa_count"
                                                                                    style="font-weight: bold"
                                                                                    align="right">
                                                                                </td>
                                                                            </tr>
                                                                            <tr style="border: 1px #000">
                                                                                <td style="border: 1px" colspan="2"
                                                                                    align="center" valign="middle">
                                                                                    <b>Jumlah
                                                                                        Material</b>
                                                                                </td>
                                                                                <td class="tabellkanan"
                                                                                    id="jumlah_material_count"
                                                                                    style="font-weight: bold"
                                                                                    align="right">
                                                                                </td>
                                                                                <td class="tabellkanan"
                                                                                    id="jumlah_material_tkdn"
                                                                                    style="font-weight: bold"
                                                                                    align="center">
                                                                                </td>
                                                                                <td class="tabellkanan"
                                                                                    id="jumlah_kdn_material_count"
                                                                                    style="font-weight: bold"
                                                                                    align="right">
                                                                                </td>
                                                                                <td class="tabellkanan"
                                                                                    id="jumlah_kln_material_count"
                                                                                    style="font-weight: bold"
                                                                                    align="right">
                                                                                </td>
                                                                                <td class="tabellkanan"
                                                                                    id="jumlah_total_tkdn_material_count"
                                                                                    style="font-weight: bold"
                                                                                    align="right">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="2" align="center"
                                                                                    valign="middle"><b>Jumlah
                                                                                        Keseluruhan</b></td>
                                                                                <td class="tabellkanan" id="td_jumlah"
                                                                                    style="font-weight: bold"
                                                                                    align="right">
                                                                                </td>
                                                                                <td class="tabellkanan kuning"
                                                                                    id="jumlah_keseluruhan_tkdn"
                                                                                    style="font-weight: bold"
                                                                                    align="center">
                                                                                </td>
                                                                                <td class="tabellkanan kuning"
                                                                                    id="total_kdn_all"
                                                                                    style="font-weight: bold"
                                                                                    align="right">
                                                                                </td>
                                                                                <td class="tabellkanan kuning"
                                                                                    id="total_kln_all"
                                                                                    style="font-weight: bold"
                                                                                    align="right">
                                                                                </td>
                                                                                <td class="tabellkanan kuning"
                                                                                    id="total_tkdn_all"
                                                                                    style="font-weight: bold"
                                                                                    align="right">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="2" align="center"
                                                                                    valign="middle"><b>PPN {{ $ppn[0]->ppn }}%</b></td>
                                                                                <td class="tabellkanan" id="td_ppn"
                                                                                    style="font-weight: bold"
                                                                                    align="right">
                                                                                </td>
                                                                                <td class="tabellkanan" id=""
                                                                                    style="font-weight: bold"
                                                                                    align="right">
                                                                                </td>
                                                                                <td class="tabellkanan" id=""
                                                                                    style="font-weight: bold"
                                                                                    align="right">
                                                                                </td>
                                                                                <td class="tabellkanan" id=""
                                                                                    style="font-weight: bold"
                                                                                    align="right">
                                                                                </td>
                                                                                <td class="tabellkanan" id=""
                                                                                    style="font-weight: bold"
                                                                                    align="right">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="2" align="center"
                                                                                    valign="middle"><b>TOTAL</b></td>
                                                                                <td class="tabellkanan kuning"
                                                                                    id="td_total"
                                                                                    style="font-weight: bold"
                                                                                    align="right">
                                                                                </td>
                                                                                <td class="tabellkanan" id=""
                                                                                    style="font-weight: bold"
                                                                                    align="right">
                                                                                </td>
                                                                                <td class="tabellkanan" id=""
                                                                                    style="font-weight: bold"
                                                                                    align="right">
                                                                                </td>
                                                                                <td class="tabellkanan" id=""
                                                                                    style="font-weight: bold"
                                                                                    align="right">
                                                                                </td>
                                                                                <td class="tabellkanan" id=""
                                                                                    style="font-weight: bold"
                                                                                    align="right">
                                                                                </td>
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
                                                        <h5 class="card-title">Step 4: Redaksi</h5>
                                                        <div class="col-xl-12 col-xxl-12">
                                                            <div class="wrapword" id="firstTable">
                                                                <table width="100%" border="2" cellspacing="0"
                                                                    cellpadding="1" style="font-size: 12px;">
                                                                    <thead align="center" valign="middle">
                                                                        <tr class="warna">
                                                                            <th style="width:4%;" align="center"
                                                                                valign="middle">No</th>
                                                                            <th style="width:10%;" align="center"
                                                                                valign="middle">Redaksi</th>
                                                                            <th style="width:35%;"align="center"
                                                                                valign="middle">Deskripsi
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
                                                    <hr>
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

    <!-- include FilePond library -->
    {{-- <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/filepond/filepond-plugin-file-validate-type.js"></script>
     <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/filepond/filepond-plugin-pdf-preview.min.js"></script>
     <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/filepond/filepond.js"></script> --}}

    {{-- <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>

     <script src="https://unpkg.com/filepond-plugin-pdf-preview/dist/filepond-plugin-pdf-preview.min.js"></script>
     <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
     <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
 --}}


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
    <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/buat_po/step5_cetak.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/buat_po/pemisah_titik.js"></script>

    <!-- Required vendors -->
    <script src="{{ asset('/') }}./asset/frontend/vendor/global/global.min.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/js/custom.min.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/js/deznav-init.js"></script>



    {{-- <script>
FilePond.registerPlugin(
    FilePondPluginFileValidateType,
    FilePondPluginPdfPreview,
    FilePondPluginFileEncode

);

const lampiran2 = document.querySelector('#lampiran2');


const pond = FilePond.create(lampiran2, {
    acceptedFileTypes: ['application/pdf'],
    fileValidateTypeDetectType: (source, type) =>
        new Promise((resolve, reject) => {
            // Do custom type detection here and return with promise

            resolve(type);
        }),
});


// const pondfiles = pond.getFiles();
console.log(pond);

</script> --}}
    <script>
        // $(document).ready(function() {
        //     var filename;
        //     $('#lampiran').change(function() {
        //         if (this.files[0].name != "") {
        //             filename = this.files[0]
        //             $('#embedLink')[0].src = window.URL.createObjectURL(new Blob([filename], {
        //                 "type": "application/pdf"
        //             }));
        //         }

        //     });



        // });

        function toggle() {

            var embedLink = document.getElementById('embedLink');
            var curVal = embedLink.style.display;
            embedLink.style.display = (curVal === 'none') ? '' : 'none';


            var lampiranfile = document.getElementById('lampiran');
            var labelfile = document.getElementById('labelfile');
            var filename;

            if (lampiranfile.value != "") {
                filename = lampiranfile.files[0]
                $('#embedLink')[0].src = window.URL.createObjectURL(new Blob([filename], {
                    "type": "application/pdf"
                }));
            } else {
                $('#embedLink')[0].src = "";
            }





        }

        function onclear() {
            var files = document.getElementById('lampiran');
            files.value = "";

            var embed = document.getElementById('embedLink');
            embed.src = "";
            embed.style.display = "none";


            var labelfile = document.getElementById('labelfile');
            labelfile.innerHTML = 'Choose or Drag file';

            event.preventDefault();

        }

        function fileValidation() {



            var fileInput = document.getElementById('lampiran');
            var feedback = document.getElementById('lampiranfile');

            var labelfile = $('#labelfile');



            var filePath = fileInput.value;

            // Allowing file type
            var allowedExtensions = filePath.split('.').pop();

            console.log(allowedExtensions);

            if (allowedExtensions != 'pdf') {

                fileInput.value = '';

            }
        }

        // function clearfile() {
        //     const file =
        //         document.querySelector('#lampiran');
        //     file.value = '';
        // }
    </script>
@endsection



<!-- <script type="text/javascript">
    window.onload = function() {
        window.location.href = "http://127.0.0.1:8000/po-khs/buat-po#spbj"
    }
</script> -->

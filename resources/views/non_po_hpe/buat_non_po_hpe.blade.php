@extends('layouts.main')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/non-po-hpe">{{ $active }}</a></li>
            <li class="breadcrumb-item active"><a href="">{{ $active1 }}</a></li>
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
                                    <a class="nav-link" href="#daftar_rab">
                                        <span class="num">2</span>
                                        Daftar RAB & HPE
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#surat_dinas">
                                        <span class="num">3</span>
                                        Buat Nota Dinas
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#preview_non_po">
                                        <span class="num">4</span>
                                        Preview HPE
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content mt-3 tab-flex">
                                @foreach ($nonpos as $nonpo)
                                    <div id="informasi_umum" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                        <form id="form-1" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                            <input type="hidden" name="_token" id="csrf"
                                                value="{{ Session::token() }}">
                                            <input type="hidden" name="non_po_id" id="non_po_id"
                                                value="{{ $non_po_id }}">
                                            <input type="hidden" name="user_id" id="user_id" value="{{ $user_id }}">
                                            <div class="row m-auto">
                                                <div class="col-lg-6 mb-2">
                                                    <div class="form-group">
                                                        <label class="text-label">Input No. Nota Dinas</label>
                                                        <input type="text" class="form-control" name="nomor_rpbj"
                                                            id="nomor_rpbj" placeholder="Nomor RPBJ" required autofocus
                                                            disabled value="{{ old('nomor_rpbj', $nonpo->nomor_rpbj) }}">
                                                        <div class="valid-feedback">
                                                            Data Terisi
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Silakan isi No. Nota Dinas
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <div class="form-group">
                                                        <label class="text-label">Input Pekerjaan</label>
                                                        <input type="text" class="form-control" name="pekerjaan"
                                                            id="pekerjaan" placeholder="Pekerjaan" required autofocus
                                                            disabled value="{{ old('pekerjaan', $nonpo->pekerjaan) }}">
                                                        <div class="valid-feedback">
                                                            Data Terisi
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Silakan isi Pekerjaan
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <div class="form-group">
                                                        <label class="text-label">Input No.SKK</label>
                                                        <select class="form-control input-default" id="skk_id"
                                                            name="skk_id" required disabled>
                                                            <option value="" selected disabled>Pilih No. SKK</option>
                                                            @foreach ($skks as $skk)
                                                                <option value="{{ $skk->id }}"
                                                                    @if ($nonpo->skk_id == $skk->id) selected @endif>
                                                                    {{ $skk->nomor_skk }}
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
                                                            name="prk_id" required disabled>
                                                            <option value="" selected disabled>Pilih PRK</option>
                                                            @foreach ($prks as $prk)
                                                                <option value="{{ $prk->id }}"
                                                                    @if ($nonpo->prk_id == $prk->id) selected @endif>
                                                                    {{ $prk->no_prk }}</option>
                                                            @endforeach
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
                                                        <label class="text-label">Start Date <span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="bi bi-calendar2-minus"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" name="start_date" id="start_date"
                                                                class="form-control datepicker-default2"required
                                                                placeholder="Tanggal mulainya pekerjaan"
                                                                style="border-radius: 0 20px 20px 0"
                                                                value="{{ old('start_date', $nonpo->startdate) }}"
                                                                disabled>
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
                                                        <label class="text-label">End Date <span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="bi bi-calendar2-minus"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" name="end_date" id="end_date"
                                                                class="form-control datepicker-default2"
                                                                placeholder="Tanggal pekerjaan selesai" readonly="false"
                                                                required autofocus style="border-radius: 0 20px 20px 0"
                                                                value="{{ old('end_date', $nonpo->enddate) }}" disabled>
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
                                                        <label class="text-label">Supervisor</label>
                                                        <input type="text" class="form-control" name="supervisor"
                                                            id="supervisor" placeholder="Supervisor" required autofocus
                                                            disabled value="{{ old('supervisor', $nonpo->supervisor) }}">
                                                        <div class="valid-feedback">
                                                            Data Terisi
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Silakan isi Supervisor
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <div class="form-group">
                                                        <label class="text-label">Pilih Manager</label>
                                                        <select class="form-control input-default" id="pejabat_id"
                                                            style="height: 60px !important ; word-wrap: normal !important; white-space: normal; overflow: hidden;   text-overflow: ellipsis;"
                                                            name="pejabat_id" required disabled>
                                                            <option value="" selected disabled>{{ $nonpo->jabatan }} - {{ $nonpo->nama_pejabat }}
                                                            </option>
                                                            @foreach ($pejabats as $pejabat)
                                                                <option value="{{ $pejabat->id }}"
                                                                    >
                                                                    {{ $pejabat->jabatan }} -
                                                                    {{ $pejabat->nama_pejabat }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="valid-feedback">
                                                            Data Terpilih
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Silakan Pilih Manager
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="daftar_rab" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                        <form id="form-2" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                            <input type="hidden" name="ppn" id="ppn"
                                                value="{{ $ppn[0]->ppn }}">
                                            <div class="row">
                                                <div class="col-xl-12 col-xxl-12">
                                                    <div class="card">
                                                        <div class="card-header justify-content-center">
                                                            <h4 class="card-title">Daftar RAB</h4>
                                                        </div>
                                                        <div class="card-header justify-content-start">
                                                            <h5 id="pagu_prk" class="card-title"
                                                                style="font-size: 14px;">Pagu PRK: <b>Rp.</b> <b
                                                                    id="rupiah">@currency($nonpos[0]->prks->prk_sisa)</b>
                                                            </h5>
                                                        </div>
                                                        <div class="row ml-2">
                                                            <div class="table-responsive">
                                                                <table id="tabelNonPO"
                                                                    class="table table-responsive-lg tabel-daftar1"
                                                                    style="width: 1428px" cellpadding="0" cellspacing="0"
                                                                    border="0">
                                                                    <thead>
                                                                        <tr align="center" valign="middle"
                                                                            class="">
                                                                            <th align="center" valign="middle"
                                                                                style="width: 60px vertical-align: middle;">
                                                                                No.</th>
                                                                            <th align="center" valign="middle"
                                                                                style="width: 322px; vertical-align: middle;">
                                                                                Uraian</th>
                                                                            <th align="center" valign="middle"
                                                                                style="width: 134px; vertical-align: middle;">
                                                                                Satuan</th>
                                                                            <th align="center" valign="middle"
                                                                                style="width: 134px; vertical-align: middle;">
                                                                                Volume</th>
                                                                            <th align="center" valign="middle"
                                                                                style="width: 209px; vertical-align: middle;">
                                                                                Harga Satuan</th>
                                                                            <th align="center" valign="middle"
                                                                                style="width: 230px; vertical-align: middle;">
                                                                                Jumlah</th>
                                                                            <th align="center" valign="middle"
                                                                                style="width: 209px; vertical-align: middle;">
                                                                                Harga Perkiraan</th>
                                                                            <th align="center" valign="middle"
                                                                                style="width: 230px; vertical-align: middle;">
                                                                                Jumlah Harga Perkiraan</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tbody-kategori">
                                                                        @foreach ($rabnonpos as $rabnonpo)
                                                                            <tr>
                                                                                <td><strong id="nomor"
                                                                                        value="1">{{ $loop->iteration }}</strong>
                                                                                </td>
                                                                                <td><input type="text"
                                                                                        class="form-control uraian"
                                                                                        id="uraian[{{ $loop->iteration }}]"
                                                                                        name="uraian"
                                                                                        placeholder="Uraian"
                                                                                        value="{{ old('uraian', $rabnonpo->uraian) }}"
                                                                                        required disabled></td>
                                                                                <td><input type="text"
                                                                                        class="form-control satuan"
                                                                                        id="satuan[{{ $loop->iteration }}]"
                                                                                        name="satuan"
                                                                                        placeholder="Satuan"
                                                                                        value="{{ old('satuan', $rabnonpo->satuan) }}"
                                                                                        required disabled></td>
                                                                                <td><input type="text"
                                                                                        class="form-control volume"
                                                                                        id="volume[{{ $loop->iteration }}]"
                                                                                        name="volume"
                                                                                        placeholder="volume"
                                                                                        value="{{ str_replace('.', ',', $rabnonpo->volume) }}"
                                                                                        onkeydown="return numbersonly(this, event);"
                                                                                        onkeyup="javascript:tandaPemisahTitik(this);"
                                                                                        required disabled></td>
                                                                                <td><input type="text"
                                                                                        class="form-control harga_satuan"
                                                                                        id="harga_satuan[{{ $loop->iteration }}]"
                                                                                        name="harga_satuan"
                                                                                        placeholder="Harga Satuan"
                                                                                        value="@currency2($rabnonpo->harga_satuan)"
                                                                                        onblur="hitung_harga(this)"
                                                                                        onkeydown="return numbersonly(this, event);"
                                                                                        onkeyup="javascript:tandaPemisahTitik(this);"
                                                                                        required disabled>
                                                                                </td>
                                                                                <td><input type="text"
                                                                                        class="form-control harga"
                                                                                        id="harga[{{ $loop->iteration }}]"
                                                                                        name="harga"
                                                                                        placeholder="Jumlah"
                                                                                        value="@currency2($rabnonpo->jumlah_harga)" disabled
                                                                                        readonly required>
                                                                                </td>
                                                                                <td><input type="text"
                                                                                        class="form-control harga_hpe"
                                                                                        id="harga_hpe[{{ $loop->iteration }}]"
                                                                                        name="harga_hpe"
                                                                                        placeholder="Harga Perkiraan"
                                                                                        value=""
                                                                                        onblur="hitung_harga_hpe(this)"
                                                                                        onkeydown="return numbersonly(this, event);"
                                                                                        onkeyup="javascript:tandaPemisahTitik(this);"
                                                                                        required>
                                                                                </td>
                                                                                <td><input type="text"
                                                                                        class="form-control jumlah_harga_hpe"
                                                                                        id="jumlah_harga_hpe[{{ $loop->iteration }}]"
                                                                                        name="jumlah_harga_hpe"
                                                                                        placeholder="Jumlah"
                                                                                        value="" disabled readonly
                                                                                        required>
                                                                                </td>
                                                                                <!-- <td><button onclick="deleteRow(this)"
                                                                                                                                                            class="btn btn-danger shadow btn-xs sharp"><i
                                                                                                                                                                class='fa fa-trash'></i></button></td> -->
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                                <!-- <div class="col-lg-12 mb-2">
                                                                                                                                            <div
                                                                                                                                                class="position-relative justify-content-end float-left">
                                                                                                                                                <a type="button" id="tambah-pekerjaan"
                                                                                                                                                    class="btn btn-primary position-relative justify-content-end"
                                                                                                                                                    onclick="updateform()" required>Tambah</a>
                                                                                                                                            </div>
                                                                                                                                        </div> -->
                                                                <table class="table table-responsive-sm height-100"
                                                                    id="tabelRAB1">
                                                                    <thead>
                                                                        <tr>
                                                                            <th></th>
                                                                            <th></th>
                                                                            <th></th>
                                                                            <th></th>
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
                                                                            <th style="width: 35%" id="jumlah">
                                                                                @currency($jumlah_harga)</th>
                                                                            <th style="width: 20%">
                                                                                Jumlah HPE:</th>
                                                                            <th style="width: 1%">:</th>
                                                                            <th style="width: 45%" id="jumlah-hpe"></th>
                                                                            <th style="width: 1%"></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th style="padding-left: 35px">PPN
                                                                                {{ str_replace('.', ',', $ppn[0]->ppn) }}%
                                                                            </th>
                                                                            <th>:</th>
                                                                            <th id="pajak">@currency($ppn_nonpo)</th>
                                                                            <th>PPN
                                                                                {{ str_replace('.', ',', $ppn[0]->ppn) }}%
                                                                            </th>
                                                                            <th>:</th>
                                                                            <th id="pajak-hpe"></th>
                                                                            <th></th>
                                                                        </tr>
                                                                        <tr>
                                                                            @if ($nonpos[0]->prks->pagu_prk >= $total_harga)
                                                                                <th style="padding-left: 35px">Total Harga
                                                                                </th>
                                                                                <th>:</th>
                                                                                <th id="total"
                                                                                    style="color: rgb(126, 126, 126);">
                                                                                    @currency($total_harga)</th>
                                                                            @else
                                                                                <th style="padding-left: 35px">Total Harga
                                                                                </th>
                                                                                <th>:</th>
                                                                                <th id="total"
                                                                                    style="color: rgb(249, 70, 135);">
                                                                                    @currency($total_harga)</th>
                                                                            @endif
                                                                            <th>Total Harga HPE</th>
                                                                            <th>:</th>
                                                                            <th id="total-hpe"></th>
                                                                            <th></th>
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
                                @endforeach
                                <div id="surat_dinas" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                    <form id="form-3" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                        <div class="col-xl-12 col-xxl-12">
                                            <div class="card-header justify-content-center">
                                                <h4 class="card-title">Nota Dinas</h4>
                                            </div>
                                        </div>
                                        <div class="row m-auto">
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Kepada : <span
                                                            class="text-danger">*</span></label>
                                                    <select name="tujuan" id="tujuan"
                                                        class="form-control input-default"
                                                        style="height: 60px !important; word-wrap: normal !important; white-space: normal; overflow: hidden;   text-overflow: ellipsis;"
                                                        required>
                                                        <option value="" selected disabled required>Pilih Tujuan
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
                                                        Data Terisi
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Silakan Pilih Tujuan </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label for="first-name" class="form-label">Dari : <span
                                                            class="text-danger">*</span></label>
                                                    <select name="sumber" id="sumber"
                                                        class="form-control input-default"
                                                        style="height: 60px !important; word-wrap: normal !important; white-space: normal; overflow: hidden;   text-overflow: ellipsis;"
                                                        required>
                                                        <option value="" selected disabled required>Pilih Sumber
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
                                                        Silakan Pilih Sumber Surat
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label for="first-name" class="form-label">Pilih Sifat Surat <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control input-default" id="sifat"
                                                        name="sifat"
                                                        style="height: 60px !important ; word-wrap: normal !important; white-space: normal; overflow: hidden;   text-overflow: ellipsis;"
                                                        required>
                                                        <option selected disabled value="">Pilih Sumber Surat
                                                        </option>
                                                        <option value="Biasa">Biasa</option>
                                                        <option value="Segera">Segera</option>
                                                        <option value="Sangat Segera">Sangat Segera</option>
                                                    </select>
                                                    <div class="valid-feedback">
                                                        Data Terpilih
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Silakan Pilih Sifat Surat
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Input Jumlah Lampiran <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="lampiran"
                                                        id="lampiran" placeholder="Jumlah Lampiran" required autofocus
                                                        value="" onkeydown="return numbersonly(this, event);"
                                                        onkeyup="javascript:tandaPemisahTitik(this);">
                                                    <div class="valid-feedback">
                                                        Data Terisi
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Silakan isi halaman lampiran
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label for="first-name" class="form-label">Pilih Jenis Lampiran Surat
                                                        <span class="text-danger">*</span></label>
                                                    <select class="form-control input-default" id="sifat_lampiran"
                                                        name="sifat_lampiran"
                                                        style="height: 60px !important ; word-wrap: normal !important; white-space: normal; overflow: hidden;   text-overflow: ellipsis;"
                                                        required>
                                                        <option selected disabled value="">Pilih Jenis Lampiran
                                                        </option>
                                                        <option value="Set">Set</option>
                                                        <option value="Lembar">Lembar</option>
                                                    </select>
                                                    <div class="valid-feedback">
                                                        Data Terpilih
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Silakan Pilih Jenis Lampiran
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Perihal : <span
                                                            class="text-danger">*</span></label>

                                                    <textarea class="form-control" name="perihal" id="perihal" placeholder="Perihal" cols="30" rows="2"
                                                        required></textarea>
                                                    <div class="valid-feedback">
                                                        Data Terisi
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Silakan isi Perihal
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label for="first-name" class="form-label">Pilih Isi Surat (Opsional)
                                                    </label>
                                                    <select class="form-control input-default" id="pilihan_surat"
                                                        name="pilihan_surat" onchange="change_redaksi(this)"
                                                        style="height: 60px !important ; word-wrap: normal !important; white-space: normal; overflow: hidden;   text-overflow: ellipsis;">
                                                        <option selected disabled value="">Pilih Isi Surat
                                                        </option>
                                                        @foreach ($redaksis as $redaksi)
                                                            <option value="{{ $redaksi->id }}">
                                                                {{ $redaksi->nama_redaksi }}</option>
                                                        @endforeach

                                                    </select>
                                                    <div class="valid-feedback">
                                                        Data Boleh Tidak Dipilih
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Isi Surat : <span
                                                            class="text-danger">*</span></label>

                                                    <textarea class="form-control" name="deskripsi_id" id="deskripsi_id" placeholder="Isi Surat" cols="60"
                                                        rows="5" required autofocus></textarea>
                                                    <div class="valid-feedback">
                                                        Data Terisi
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Silakan isi Surat
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Redaksi Nota Dinas :</label>
                                                    <select
                                                        name="redaksi_id" id="redaksi_id"
                                                        class="form-control input-default"
                                                        onchange="change_redaksi(this)"
                                                        style="height: 60px !important; word-wrap: normal !important; white-space: normal; overflow: hidden;   text-overflow: ellipsis;"
                                                        required>
                                                        <option value="" selected disabled
                                                            required>Pilih Redaksi</option>
                                                        @foreach ($redaksis as $redaksi)
                                                            <option value="{{ $redaksi->id }}">
                                                                {{ $redaksi->nama_redaksi }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Deskripsi Redaksi Nota Dinas :</label>
                                                    <p id="deskripsi_id" name="deskripsi_id">
                                                    </p>
                                                </div>
                                            </div> --}}
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="text-label">Input Tembusan (Opsional) </label>
                                                </div>
                                            </div>
                                            <table class="table table-responsive-sm height-100" width="100%"
                                                id="tabel_tembusan">
                                                <tr align="center" valign="middle" class="">
                                                    <th style="width:5%;" align="center" valign="middle">No.</th>
                                                    <th align="center" valign="middle">Tembusan</th>
                                                    <th style="width:10%;" align="center" valign="middle">Aksi</th>
                                                </tr>
                                                {{-- <tr>
                                                    <td><strong id="nomor" value="1">1</strong></td>
                                                    <td> <input type="text" class="form-control" name="tembusan"
                                                            id="tembusan[1]" placeholder="Tembusan" autofocus
                                                            value="{{ old('tembusan') }}"></td>
                                                    <td align="center"><button onclick="deleteRow3(this)"
                                                            class="btn btn-danger shadow btn-xs sharp"><i
                                                                class='fa fa-trash'></i></button></td>
                                                </tr> --}}
                                            </table>
                                            <div class="col-lg-12 mb-2">
                                                <div class="position-relative justify-content-center float-center">
                                                    <a type="button" id="tambah-pekerjaan"
                                                        class="btn btn-secondary btn-xs position-relative justify-content-end"
                                                        onclick="updatetembusan()" required>Tambah</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="preview_non_po" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                                    <form id="form-4" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                        <div class="row">
                                            <div class="col-xl-12 col-xxl-12">
                                                <div class="card">
                                                    <div class="card-header justify-content-center">
                                                        <h4 class="card-title">Preview Kontrak NON PO</h4>
                                                    </div>
                                                    <div class="row ml-2 justify-content-start">
                                                        <h5 class="card-title">Step 1: Informasi Umum</h5>
                                                        <table class="uprightTbl noborder" style="width:100%;"
                                                            id="rincian" cellspacing="0" cellpadding="0">
                                                            <tr class="noborder">
                                                                <td style="width:20%;">No. RPBJ
                                                                </td>
                                                                <td style="width:1%">:</td>
                                                                <td id="nomor_rpbj_3">
                                                                </td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>No. SKK</td>
                                                                <td>:</td>
                                                                <td id="no_skk_3"></td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>No. PRK</td>
                                                                <td>:</td>
                                                                <td id="no_prk_3"></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <hr>
                                                    <div class="row ml-2 justify-content-start">
                                                        <h5 class="card-title">Step 2: Daftar RAB & HPE</h5>
                                                        <div class="col-xl-12 col-xxl-12">
                                                            <div class="table-responsive">
                                                                <div class="wrapword" id="firstTable">
                                                                    <table class="" width="100%" border="2"
                                                                        cellspacing="0" cellpadding="0">
                                                                        <thead>
                                                                            <tr class="warna">
                                                                                <td style="width:4%;" rowspan="2"
                                                                                    align="center" valign="middle">No</td>
                                                                                <td rowspan="2" align="center"
                                                                                    valign="middle">Uraian Pekerjaan</td>
                                                                                <td style="width:9%;" rowspan="2"
                                                                                    align="center" valign="middle">Satuan
                                                                                </td>
                                                                                <td style="width:9%;" rowspan="2"
                                                                                    align="center" valign="middle">Volume
                                                                                </td>
                                                                                <td style="width:25%;" colspan="2"
                                                                                    align="center" valign="middle">Harga
                                                                                </td>
                                                                                <td style="width:25%;" colspan="2"
                                                                                    align="center" valign="middle">Harga
                                                                                    HPE
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="warna">
                                                                                <td style="width:12%;" align="center"
                                                                                    valign="middle">Satuan (RP)</td>
                                                                                <td style="width:15%;" align="center"
                                                                                    valign="middle">Jumlah (RP)</td>
                                                                                <td style="width:12%;" align="center"
                                                                                    valign="middle">Satuan HPE (RP)</td>
                                                                                <td style="width:15%;" align="center"
                                                                                    valign="middle">Jumlah HPE (RP)</td>
                                                                            </tr>
                                                                            <!-- <tr class="warna">
                                                                                                                                                        </tr> -->
                                                                        </thead>
                                                                        <tbody id="uraian_rab">
                                                                        </tbody>
                                                                        <tfoot>
                                                                            <tr>
                                                                                <td rowspan="3" colspan="3"></td>
                                                                                <td colspan="2" align="center"
                                                                                    valign="middle"><b>Jumlah</b></td>
                                                                                <td id="td_jumlah"
                                                                                    style="font-weight: bold"
                                                                                    align="right"></td>
                                                                                <td colspan="1" align="center"
                                                                                    valign="middle"><b>Jumlah HPE:</b></td>
                                                                                <td id="td_jumlah_hpe"
                                                                                    style="font-weight: bold"
                                                                                    align="right"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="2" align="center"
                                                                                    valign="middle"><b>PPN 11%</b></td>
                                                                                <td id="td_ppn"
                                                                                    style="font-weight: bold"
                                                                                    align="right"></td>
                                                                                <td colspan="1" align="center"
                                                                                    valign="middle"><b>PPN 11%</b></td>
                                                                                <td id="td_ppn_hpe"
                                                                                    style="font-weight: bold"
                                                                                    align="right"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="2" align="center"
                                                                                    valign="middle"><b>TOTAL</b></td>
                                                                                <td id="td_total"
                                                                                    style="font-weight: bold"
                                                                                    align="right"></td>
                                                                                </td>
                                                                                <td colspan="1" align="center"
                                                                                    valign="middle"><b>TOTAL HPE</b></td>
                                                                                <td id="td_total_hpe"
                                                                                    style="font-weight: bold"
                                                                                    align="right"></td>
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
                                                                        <!-- <tr>
                                                                                                                                                            <td class="first1"></td>
                                                                                                                                                        </tr> -->
                                                                    </table>
                                                                    {{-- <div>
                                                                        <button id="prevpdf">Previous</button>
                                                                        <button id="nextpdf">Next</button>
                                                                        &nbsp; &nbsp;
                                                                        <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
                                                                    </div>
                                                                    <canvas id="pdfViewer"></canvas> --}}
                                                                    {{-- <embed width="100%" height="600px" type="application/pdf" id="embedLink"/> --}}

                                                                    <!-- <object type="application/pdf" id="pdfViewer" type="">
                                                                                                                                                        <embed id="pdfViewer2" width="100%" height="600px" >
                                                                                                                                                    </object> -->

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>

                                                    <div class="row ml-2 justify-content-start">
                                                        <h5 class="card-title">Step 3: Nota Dinas </h5>
                                                        <table class="uprightTbl noborder" style="width:100%;"
                                                            id="rincian" cellspacing="0" cellpadding="0">
                                                            <tr class="noborder">
                                                                <td style="width:20%;">Kepada
                                                                </td>
                                                                <td style="width:1%">:</td>
                                                                <td id="tujuan1">
                                                                </td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>Dari</td>
                                                                <td>:</td>
                                                                <td id="sumber1"></td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>Sifat</td>
                                                                <td>:</td>
                                                                <td id="sifat1"></td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>Lampiran</td>
                                                                <td>:</td>
                                                                <td id="lampiran1"></td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>Perihal</td>
                                                                <td>:</td>
                                                                <td id="perihal1"></td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td valign="top">Isi Surat</td>
                                                                <td valign="top">:</td>
                                                                <td id="isi_surat1"></td>
                                                            </tr>
                                                            <tbody id="body_tembusan"></tbody>
                                                        </table>
                                                    </div>
                                                    <hr>

                                                    <div class="d-flex">
                                                        <div class="col-lg-6">
                                                            <div class="col-lg-12">
                                                                <div class=" align-items-start text-center">
                                                                    <h5 class="card-title" style="text-align: center">
                                                                        Preview
                                                                        KAK </h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <embed src="{{ asset('storage/' . $lampiran->kak . '') }}"
                                                                    width="100%" height="450px" name="plugin"
                                                                    id="embedLink" type="application/pdf" />
                                                            </div>
                                                        </div>
                                                        {{-- <div class="position-relative justify-content-end float-right sweetalert">
                                                                <button type="button" id="btnPrvw"
                                                                class="btn btn-primary position-relative justify-content-end">Preview <i class="bi bi-eye"></i></button>
                                                            </div> --}}
                                                        <div class="col-lg-6">
                                                            <div class="col-lg-12">
                                                                <div class=" align-items-center text-center">
                                                                    <h5 class="card-title" style="text-align: center">
                                                                        Preview
                                                                        Nota Dinas </h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <embed
                                                                    src="{{ asset('storage/' . $lampiran->nota_dinas . '') }}"
                                                                    width="100%" height="450px" name="embedlink2"
                                                                    id="embedlink2" type="application/pdf" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalLabel">Order Placed</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> X </button>
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

        <!-- Preview PDF -->
        <!-- <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script> -->
        {{-- <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script> --}}


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
        {{-- <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/jquery.smartWizard.min.js"></script>
        <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/wizard.js"></script> --}}

        <script src="{{ asset('/') }}./asset/frontend/vendor/global/global.min.js"></script>
        <script src="{{ asset('/') }}./asset/frontend/js/custom.min.js"></script>
        <script src="{{ asset('/') }}./asset/frontend/js/deznav-init.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {

                // $('#btnPrvw').click(function() {
                // });
            });

            const myModal = new bootstrap.Modal(document.getElementById('confirmModal'));

            function onCancel() {
                // Reset wizard
                $('#smartwizard').smartWizard("reset");

                // Reset form
                document.getElementById("form-1").reset();
                document.getElementById("form-2").reset();
                document.getElementById("form-3").reset();
                document.getElementById("form-4").reset();
                document.getElementById("jumlah-hpe").innerHTML = "";
                document.getElementById("pajak-hpe").innerHTML = "";
                document.getElementById("total-hpe").innerHTML = "";
            }

            // function onConfirm() {
            //     let form = document.getElementById('form-3');
            //     if (form) {
            //         if (!form.checkValidity()) {
            //             form.classList.add('was-validated');
            //             $('#smartwizard').smartWizard("setState", [3], 'error');
            //             $("#smartwizard").smartWizard('fixHeight');
            //             return false;
            //         }

            //         $('#smartwizard').smartWizard("unsetState", [3], 'error');
            //         myModal.show();
            //     }
            // }

            // function closeModal() {
            //     // Reset wizard
            //     $('#smartwizard').smartWizard("reset");

            //     // Reset form
            //     document.getElementById("form-1").reset();
            //     document.getElementById("form-2").reset();
            //     document.getElementById("form-3").reset();
            //     // document.getElementById("form-4").reset();

            //     myModal.hide();
            // }

            function change_redaksi(c) {
                let token = $('#csrf').val();
                // alert(token);
                var redaksi_id = document.getElementById("pilihan_surat").value;
                // alert(redaksi_id);

                $.ajax({
                    url: '/getDeskripsiNota',
                    type: "POST",

                    data: {
                        'redaksi_id': redaksi_id,
                        '_token': token,


                    },
                    success: function(response) {
                        document.getElementById("deskripsi_id").value = response.deskripsi_redaksi;
                    }
                })

            }



            function showConfirm() {
                const name = $('#lokasi').val() + ' ' + $('#lokasi').val();
                const products = $('#lokasi').val();
                const shipping = $('#lokasi').val() + ' ' + $('#lokasi').val() + ' ' + $('#lokasi').val();
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
                        $("#prev-btn").addClass('disabled').prop('disabled', true);
                        $(".sw-btn-next").prop('disabled', false)
                    } else if (stepPosition === 'second') {
                        if (document.getElementById('total-hpe').innerHTML != "") {
                            var total = document.getElementById('total-hpe').innerHTML;
                            total = total.replace(/\Rp. /g, "");
                            total = total.replace(/\./g, "");
                            total = parseFloat(total);
                            // console.log(total);
                            if (total >= 100000000) {
                                $(".sw-btn-next").prop('disabled', true)
                            }
                        }
                    } else if (stepPosition === 'fourth') {
                        var nomor_rpbj = $("#nomor_rpbj").val();
                        var skk_id = $("#skk_id option:selected").text();
                        var prk_id = $("#prk_id option:selected").text();

                        $("#nomor_rpbj_3").html(nomor_rpbj);
                        $("#no_skk_3").html(skk_id);
                        $("#no_prk_3").html(prk_id);


                        var tujuan = $("#tujuan option:selected").text();
                        console.log(tujuan);
                        var sumber = $("#sumber option:selected").text();
                        var sifat = $("#sifat option:selected").text();
                        var lampiran = $("#lampiran").val();
                        console.log(lampiran);
                        var sifat_lampiran = $("#sifat_lampiran option:selected").text();
                        var perihal = $("#perihal").val();
                        var isi_surat = $("#deskripsi_id").val();

                        $("#tujuan1").html(tujuan);
                        $("#sumber1").html(sumber);
                        $("#sifat1").html(sifat);
                        $("#lampiran1").html(lampiran + " " + sifat_lampiran);
                        $("#perihal1").html(perihal);
                        $("#isi_surat1").html(isi_surat);




                        baris = [];
                        var banyak_data = document.querySelectorAll("#tbody-kategori tr");

                        for (var i = 0; i < banyak_data.length; i++) {
                            baris[i] = [
                                // $("#item_id[" + (i + 1) + "] option:selected").text(),
                                document.getElementById("uraian[" + (i + 1) + "]").value,
                                document.getElementById("satuan[" + (i + 1) + "]").value,
                                document.getElementById("volume[" + (i + 1) + "]").value,
                                document.getElementById("harga_satuan[" + (i + 1) + "]").value,
                                document.getElementById("harga[" + (i + 1) + "]").value,
                                document.getElementById("harga_hpe[" + (i + 1) + "]").value,
                                document.getElementById("jumlah_harga_hpe[" + (i + 1) + "]").value,
                            ]
                        }
                        console.log("baris", baris);

                        const result_rab_non_po = baris.filter(element => {
                            return element !== null;
                        })

                        // console.log("result_rab_non_po", result_rab_non_po);

                        if (result_rab_non_po.length > 0) {
                            var html_rab = [""];
                            var tbody = document.getElementById("uraian_rab");
                            var array_length = result_rab_non_po.length;
                            for (var j = 0; j < array_length; j++) {
                                html_rab += ("<tr> <td class='first' align='center' valign='middle'>" + (j +
                                        1) + "</td> <td class='first' align='left' valign='middle'>" +
                                    result_rab_non_po[j][0] +
                                    "</td> <td class='first' align='center' valign='middle'>" +
                                    result_rab_non_po[j][1] +
                                    "</td> <td class='first' align='center' valign='middle'>" +
                                    result_rab_non_po[j][2] +
                                    "</td> <td class='first' align='right' valign='middle'>" +
                                    result_rab_non_po[j][3] +
                                    "</td> <td class='first' align='right' valign='middle'>" +
                                    result_rab_non_po[j][4] +
                                    "</td> <td class='first' align='right' valign='middle'>" +
                                    result_rab_non_po[j][5] +
                                    "</td> <td class='first' align='right' valign='middle'>" +
                                    result_rab_non_po[j][6] + "</td> </tr>")
                            }
                            console.log("html_rab", html_rab);
                            document.getElementById("uraian_rab").innerHTML =
                                "<tr> <td class='first' align='center' valign='middle'><td class='first' align='center' valign='middle'></td> <td class='first' align='center' valign='middle'></td> <td class='first' align='right' valign='middle'></td> <td class='first' align='right' valign='middle'></td> </tr>" +
                                html_rab;
                        }
                        document.getElementById("td_jumlah").innerHTML = document.getElementById("jumlah")
                            .innerHTML;
                        document.getElementById("td_jumlah_hpe").innerHTML = document.getElementById(
                                "jumlah-hpe")
                            .innerHTML;
                        document.getElementById("td_ppn").innerHTML = document.getElementById("pajak")
                            .innerHTML;
                        document.getElementById("td_ppn_hpe").innerHTML = document.getElementById("pajak-hpe")
                            .innerHTML;
                        document.getElementById("td_total").innerHTML = document.getElementById("total")
                            .innerHTML;
                        document.getElementById("td_total_hpe").innerHTML = document.getElementById("total-hpe")
                            .innerHTML;

                        $("#next-btn").addClass('disabled').prop('disabled', true);
                        // alert(click);
                    } else {
                        $("#prev-btn").removeClass('disabled').prop('disabled', false);
                        $("#next-btn").removeClass('disabled').prop('disabled', false);
                    }

                    // Get step info from Smart Wizard
                    let stepInfo = $('#smartwizard').smartWizard("getStepInfo");
                    $("#sw-current-step").text(stepInfo.currentStep + 1);
                    $("#sw-total-step").text(stepInfo.totalSteps);

                    if (stepPosition == 'fourth') {
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
                        extraHtml: `<button class="btn btn-success" id="btnFinish" disabled onclick="onSubmitData()">Cetak</button>
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

        <script>
            var clicktembusan = 0;

            function hitung_harga_hpe(c) {
                var row = c.parentNode.parentNode;
                var change = row.rowIndex;
                var banyak_data = document.querySelectorAll("#tbody-kategori tr");
                // tbody.querySelectorAll()
                var volume = document.getElementById("volume[" + change + "]").value;
                volume = volume.replace(/\./g, "");
                volume = volume.replace(/\,/g, ".");
                volume = parseFloat(volume);
                var harga_perkiraan = document.getElementById("harga_hpe[" + change + "]").value;
                harga_perkiraan = harga_perkiraan.replace(/\./g, "");
                harga_perkiraan = parseInt(harga_perkiraan);

                var jumlah_harga_perkiraan = volume * harga_perkiraan;
                jumlah_harga_perkiraan = jumlah_harga_perkiraan.toString();
                jumlah_harga_perkiraan_2 = "";
                panjang = jumlah_harga_perkiraan.length;
                j = 0;
                for (i = panjang; i > 0; i--) {
                    j = j + 1;
                    if (((j % 3) == 1) && (j != 1)) {
                        jumlah_harga_perkiraan_2 = jumlah_harga_perkiraan.substr(i - 1, 1) + "." + jumlah_harga_perkiraan_2;
                    } else {
                        jumlah_harga_perkiraan_2 = jumlah_harga_perkiraan.substr(i - 1, 1) + jumlah_harga_perkiraan_2;
                    }
                }
                if (document.getElementById('volume[' + change + ']').value != "" && document.getElementById('harga_hpe[' +
                        change + ']').value != "") {
                    document.getElementById("jumlah_harga_hpe[" + change + "]").value = jumlah_harga_perkiraan_2;
                }

                var volume_check = [];
                var harga_perkiraan_check = [];
                var jumlah_harga_perkiraan_check = [];

                for (var i = 0; i < banyak_data.length; i++) {
                    volume_check[i] = document.getElementById('volume[' + (i + 1) + ']').value
                    harga_perkiraan_check[i] = document.getElementById('harga_hpe[' + (i + 1) + ']').value
                    jumlah_harga_perkiraan_check[i] = document.getElementById('jumlah_harga_hpe[' + (i + 1) + ']').value
                }

                if (volume_check.includes('') || harga_perkiraan_check.includes('') || jumlah_harga_perkiraan_check.includes(
                        '')) {
                    return false;
                } else {

                }

                var total_harga = [];
                for (var i = 0; i < banyak_data.length; i++) {
                    total_harga[i] = document.getElementById("jumlah_harga_hpe[" + (i + 1) + "]").value;
                    total_harga[i] = total_harga[i].replace(/\./g, "");
                    total_harga[i] = parseInt(total_harga[i])
                }
                var pagu_prk = document.getElementById("rupiah").innerHTML;
                pagu_prk = pagu_prk.replace(/\./g, "");
                pagu_prk = parseInt(pagu_prk);
                var total_harga_all = total_harga.reduce((accumulator, currentvalue) => accumulator + currentvalue);
                total_harga_all = total_harga_all.toString();
                total_harga_all_2 = "";
                panjang_2 = total_harga_all.length;
                k = 0;
                for (i = panjang_2; i > 0; i--) {
                    k = k + 1;
                    if (((k % 3) == 1) && (k != 1)) {
                        total_harga_all_2 = total_harga_all.substr(i - 1, 1) + "." + total_harga_all_2;
                    } else {
                        total_harga_all_2 = total_harga_all.substr(i - 1, 1) + total_harga_all_2;
                    }
                }
                document.getElementById("jumlah-hpe").innerHTML = "Rp. " + total_harga_all_2;
                total_harga_all = parseInt(total_harga_all);
                var ppn_id = document.getElementById('ppn').value;
                ppn_id = parseFloat(ppn_id);
                var ppn = total_harga_all * ppn_id / 100;
                ppn = Math.round(ppn);
                ppn = ppn.toString();
                ppn_2 = ""
                panjang_3 = ppn.length;
                l = 0;
                for (i = panjang_3; i > 0; i--) {
                    l = l + 1;
                    if (((l % 3) == 1) && (l != 1)) {
                        ppn_2 = ppn.substr(i - 1, 1) + "." + ppn_2;
                    } else {
                        ppn_2 = ppn.substr(i - 1, 1) + ppn_2;
                    }
                }
                document.getElementById("pajak-hpe").innerHTML = "Rp. " + ppn_2;
                ppn = parseInt(ppn);
                var total = total_harga_all + ppn;
                total = Math.round(total);

                if (document.getElementById('total-hpe').innerHTML == "") {
                    if (total < 50000000) {
                        if (pagu_prk >= total) {
                            total = total.toString();
                            total_2 = "";
                            panjang_4 = total.length;
                            m = 0;
                            for (i = panjang_4; i > 0; i--) {
                                m = m + 1;
                                if (((m % 3) == 1) && (m != 1)) {
                                    total_2 = total.substr(i - 1, 1) + "." + total_2;
                                } else {
                                    total_2 = total.substr(i - 1, 1) + total_2;
                                }
                            }
                            document.getElementById("total-hpe").innerHTML = "Rp. " + total_2;
                            document.getElementById("total-hpe").style.color = '#7E7E7E';
                        } else {
                            total = total.toString();
                            total_2 = "";
                            panjang_4 = total.length;
                            m = 0;
                            for (i = panjang_4; i > 0; i--) {
                                m = m + 1;
                                if (((m % 3) == 1) && (m != 1)) {
                                    total_2 = total.substr(i - 1, 1) + "." + total_2;
                                } else {
                                    total_2 = total.substr(i - 1, 1) + total_2;
                                }
                            }
                            document.getElementById("total-hpe").innerHTML = "Rp. " + total_2;
                            document.getElementById("total-hpe").style.color = '#F94687';
                        }
                        $(".sw-btn-next").prop('disabled', false);
                    } else if (total >= 50000000 && total < 100000000) {
                        swal({
                                title: "Total Harga Telah Mencapai 50 Juta",
                                text: "Total Harga HPE Telah Mencapai 50 Juta",
                                icon: "warning",
                                timer: 2e3,
                                buttons: false
                            })
                            .then((willContinue) => {
                                if (pagu_prk >= total) {
                                    total = total.toString();
                                    total_2 = "";
                                    panjang_4 = total.length;
                                    m = 0;
                                    for (i = panjang_4; i > 0; i--) {
                                        m = m + 1;
                                        if (((m % 3) == 1) && (m != 1)) {
                                            total_2 = total.substr(i - 1, 1) + "." + total_2;
                                        } else {
                                            total_2 = total.substr(i - 1, 1) + total_2;
                                        }
                                    }
                                    document.getElementById("total-hpe").innerHTML = "Rp. " + total_2;
                                    document.getElementById("total-hpe").style.color = '#7E7E7E';
                                } else {
                                    total = total.toString();
                                    total_2 = "";
                                    panjang_4 = total.length;
                                    m = 0;
                                    for (i = panjang_4; i > 0; i--) {
                                        m = m + 1;
                                        if (((m % 3) == 1) && (m != 1)) {
                                            total_2 = total.substr(i - 1, 1) + "." + total_2;
                                        } else {
                                            total_2 = total.substr(i - 1, 1) + total_2;
                                        }
                                    }
                                    document.getElementById("total-hpe").innerHTML = "Rp. " + total_2;
                                    document.getElementById("total-hpe").style.color = '#F94687';
                                }
                                $(".sw-btn-next").prop('disabled', false);
                            })
                    } else {
                        swal({
                                title: "Total Harga Telah Mencapai 100 Juta",
                                text: "Anda Tidak Dapat Melanjutkan Pembuatan HPE",
                                icon: "error",
                                timer: 2e3,
                                buttons: false
                            })
                            .then((willContinue) => {
                                if (pagu_prk >= total) {
                                    total = total.toString();
                                    total_2 = "";
                                    panjang_4 = total.length;
                                    m = 0;
                                    for (i = panjang_4; i > 0; i--) {
                                        m = m + 1;
                                        if (((m % 3) == 1) && (m != 1)) {
                                            total_2 = total.substr(i - 1, 1) + "." + total_2;
                                        } else {
                                            total_2 = total.substr(i - 1, 1) + total_2;
                                        }
                                    }
                                    document.getElementById("total-hpe").innerHTML = "Rp. " + total_2;
                                    document.getElementById("total-hpe").style.color = '#7E7E7E';
                                } else {
                                    total = total.toString();
                                    total_2 = "";
                                    panjang_4 = total.length;
                                    m = 0;
                                    for (i = panjang_4; i > 0; i--) {
                                        m = m + 1;
                                        if (((m % 3) == 1) && (m != 1)) {
                                            total_2 = total.substr(i - 1, 1) + "." + total_2;
                                        } else {
                                            total_2 = total.substr(i - 1, 1) + total_2;
                                        }
                                    }
                                    document.getElementById("total-hpe").innerHTML = "Rp. " + total_2;
                                    document.getElementById("total-hpe").style.color = '#F94687';
                                }
                                $(".sw-btn-next").prop('disabled', true);
                            })
                    }
                } else {
                    var total_step2 = document.getElementById('total-hpe').innerHTML;
                    total_step2 = total_step2.replace(/\Rp. /g, "");
                    total_step2 = total_step2.replace(/\./g, "");
                    total_step2 = parseFloat(total_step2);

                    if (total_step2 < 50000000 && total < 50000000) {
                        if (pagu_prk >= total) {
                            total = total.toString();
                            total_2 = "";
                            panjang_4 = total.length;
                            m = 0;
                            for (i = panjang_4; i > 0; i--) {
                                m = m + 1;
                                if (((m % 3) == 1) && (m != 1)) {
                                    total_2 = total.substr(i - 1, 1) + "." + total_2;
                                } else {
                                    total_2 = total.substr(i - 1, 1) + total_2;
                                }
                            }
                            document.getElementById("total-hpe").innerHTML = "Rp. " + total_2;
                            document.getElementById("total-hpe").style.color = '#7E7E7E';
                        } else {
                            total = total.toString();
                            total_2 = "";
                            panjang_4 = total.length;
                            m = 0;
                            for (i = panjang_4; i > 0; i--) {
                                m = m + 1;
                                if (((m % 3) == 1) && (m != 1)) {
                                    total_2 = total.substr(i - 1, 1) + "." + total_2;
                                } else {
                                    total_2 = total.substr(i - 1, 1) + total_2;
                                }
                            }
                            document.getElementById("total-hpe").innerHTML = "Rp. " + total_2;
                            document.getElementById("total-hpe").style.color = '#F94687';
                        }
                        $(".sw-btn-next").prop('disabled', false);
                    } else if (total_step2 < 50000000 && total >= 50000000) {
                        if (total >= 100000000) {
                            swal({
                                    title: "Total Harga Telah Mencapai 100 Juta",
                                    text: "Anda Tidak Dapat Melanjutkan Pembuatan HPE",
                                    icon: "error",
                                    timer: 2e3,
                                    buttons: false
                                })
                                .then((willContinue) => {
                                    if (pagu_prk >= total) {
                                        total = total.toString();
                                        total_2 = "";
                                        panjang_4 = total.length;
                                        m = 0;
                                        for (i = panjang_4; i > 0; i--) {
                                            m = m + 1;
                                            if (((m % 3) == 1) && (m != 1)) {
                                                total_2 = total.substr(i - 1, 1) + "." + total_2;
                                            } else {
                                                total_2 = total.substr(i - 1, 1) + total_2;
                                            }
                                        }
                                        document.getElementById("total-hpe").innerHTML = "Rp. " + total_2;
                                        document.getElementById("total-hpe").style.color = '#7E7E7E';
                                    } else {
                                        total = total.toString();
                                        total_2 = "";
                                        panjang_4 = total.length;
                                        m = 0;
                                        for (i = panjang_4; i > 0; i--) {
                                            m = m + 1;
                                            if (((m % 3) == 1) && (m != 1)) {
                                                total_2 = total.substr(i - 1, 1) + "." + total_2;
                                            } else {
                                                total_2 = total.substr(i - 1, 1) + total_2;
                                            }
                                        }
                                        document.getElementById("total-hpe").innerHTML = "Rp. " + total_2;
                                        document.getElementById("total-hpe").style.color = '#F94687';
                                    }
                                    $(".sw-btn-next").prop('disabled', true);
                                })
                        } else {
                            swal({
                                    title: "Total Harga Telah Mencapai 50 Juta",
                                    text: "Total Harga HPE Telah Mencapai 50 Juta",
                                    icon: "warning",
                                    timer: 2e3,
                                    buttons: false
                                })
                                .then((willContinue) => {
                                    if (pagu_prk >= total) {
                                        total = total.toString();
                                        total_2 = "";
                                        panjang_4 = total.length;
                                        m = 0;
                                        for (i = panjang_4; i > 0; i--) {
                                            m = m + 1;
                                            if (((m % 3) == 1) && (m != 1)) {
                                                total_2 = total.substr(i - 1, 1) + "." + total_2;
                                            } else {
                                                total_2 = total.substr(i - 1, 1) + total_2;
                                            }
                                        }
                                        document.getElementById("total-hpe").innerHTML = "Rp. " + total_2;
                                        document.getElementById("total-hpe").style.color = '#7E7E7E';
                                    } else {
                                        total = total.toString();
                                        total_2 = "";
                                        panjang_4 = total.length;
                                        m = 0;
                                        for (i = panjang_4; i > 0; i--) {
                                            m = m + 1;
                                            if (((m % 3) == 1) && (m != 1)) {
                                                total_2 = total.substr(i - 1, 1) + "." + total_2;
                                            } else {
                                                total_2 = total.substr(i - 1, 1) + total_2;
                                            }
                                        }
                                        document.getElementById("total-hpe").innerHTML = "Rp. " + total_2;
                                        document.getElementById("total-hpe").style.color = '#F94687';
                                    }
                                    $(".sw-btn-next").prop('disabled', false);
                                })
                        }
                    } else if (total_step2 >= 50000000 && total >= 100000000) {
                        if (total_step2 < 100000000) {
                            swal({
                                    title: "Total Harga Telah Mencapai 100 Juta",
                                    text: "Anda Tidak Dapat Melanjutkan Pembuatan HPE",
                                    icon: "error",
                                    timer: 2e3,
                                    buttons: false
                                })
                                .then((willContinue) => {
                                    if (pagu_prk >= total) {
                                        total = total.toString();
                                        total_2 = "";
                                        panjang_4 = total.length;
                                        m = 0;
                                        for (i = panjang_4; i > 0; i--) {
                                            m = m + 1;
                                            if (((m % 3) == 1) && (m != 1)) {
                                                total_2 = total.substr(i - 1, 1) + "." + total_2;
                                            } else {
                                                total_2 = total.substr(i - 1, 1) + total_2;
                                            }
                                        }
                                        document.getElementById("total-hpe").innerHTML = "Rp. " + total_2;
                                        document.getElementById("total-hpe").style.color = '#7E7E7E';
                                    } else {
                                        total = total.toString();
                                        total_2 = "";
                                        panjang_4 = total.length;
                                        m = 0;
                                        for (i = panjang_4; i > 0; i--) {
                                            m = m + 1;
                                            if (((m % 3) == 1) && (m != 1)) {
                                                total_2 = total.substr(i - 1, 1) + "." + total_2;
                                            } else {
                                                total_2 = total.substr(i - 1, 1) + total_2;
                                            }
                                        }
                                        document.getElementById("total-hpe").innerHTML = "Rp. " + total_2;
                                        document.getElementById("total-hpe").style.color = '#F94687';
                                    }
                                    $(".sw-btn-next").prop('disabled', true);
                                })
                        } else {
                            if (pagu_prk >= total) {
                                total = total.toString();
                                total_2 = "";
                                panjang_4 = total.length;
                                m = 0;
                                for (i = panjang_4; i > 0; i--) {
                                    m = m + 1;
                                    if (((m % 3) == 1) && (m != 1)) {
                                        total_2 = total.substr(i - 1, 1) + "." + total_2;
                                    } else {
                                        total_2 = total.substr(i - 1, 1) + total_2;
                                    }
                                }
                                document.getElementById("total-hpe").innerHTML = "Rp. " + total_2;
                                document.getElementById("total-hpe").style.color = '#7E7E7E';
                            } else {
                                total = total.toString();
                                total_2 = "";
                                panjang_4 = total.length;
                                m = 0;
                                for (i = panjang_4; i > 0; i--) {
                                    m = m + 1;
                                    if (((m % 3) == 1) && (m != 1)) {
                                        total_2 = total.substr(i - 1, 1) + "." + total_2;
                                    } else {
                                        total_2 = total.substr(i - 1, 1) + total_2;
                                    }
                                }
                                document.getElementById("total-hpe").innerHTML = "Rp. " + total_2;
                                document.getElementById("total-hpe").style.color = '#F94687';
                            }
                            $(".sw-btn-next").prop('disabled', true);
                        }
                    } else if (total_step2 >= 100000000 && total < 100000000) {
                        if (pagu_prk >= total) {
                            total = total.toString();
                            total_2 = "";
                            panjang_4 = total.length;
                            m = 0;
                            for (i = panjang_4; i > 0; i--) {
                                m = m + 1;
                                if (((m % 3) == 1) && (m != 1)) {
                                    total_2 = total.substr(i - 1, 1) + "." + total_2;
                                } else {
                                    total_2 = total.substr(i - 1, 1) + total_2;
                                }
                            }
                            document.getElementById("total-hpe").innerHTML = "Rp. " + total_2;
                            document.getElementById("total-hpe").style.color = '#7E7E7E';
                        } else {
                            total = total.toString();
                            total_2 = "";
                            panjang_4 = total.length;
                            m = 0;
                            for (i = panjang_4; i > 0; i--) {
                                m = m + 1;
                                if (((m % 3) == 1) && (m != 1)) {
                                    total_2 = total.substr(i - 1, 1) + "." + total_2;
                                } else {
                                    total_2 = total.substr(i - 1, 1) + total_2;
                                }
                            }
                            document.getElementById("total-hpe").innerHTML = "Rp. " + total_2;
                            document.getElementById("total-hpe").style.color = '#F94687';
                        }
                        $(".sw-btn-next").prop('disabled', false);
                    } else if (total_step2 >= 50000000 && total < 50000000) {
                        if (pagu_prk >= total) {
                            total = total.toString();
                            total_2 = "";
                            panjang_4 = total.length;
                            m = 0;
                            for (i = panjang_4; i > 0; i--) {
                                m = m + 1;
                                if (((m % 3) == 1) && (m != 1)) {
                                    total_2 = total.substr(i - 1, 1) + "." + total_2;
                                } else {
                                    total_2 = total.substr(i - 1, 1) + total_2;
                                }
                            }
                            document.getElementById("total-hpe").innerHTML = "Rp. " + total_2;
                            document.getElementById("total-hpe").style.color = '#7E7E7E';
                        } else {
                            total = total.toString();
                            total_2 = "";
                            panjang_4 = total.length;
                            m = 0;
                            for (i = panjang_4; i > 0; i--) {
                                m = m + 1;
                                if (((m % 3) == 1) && (m != 1)) {
                                    total_2 = total.substr(i - 1, 1) + "." + total_2;
                                } else {
                                    total_2 = total.substr(i - 1, 1) + total_2;
                                }
                            }
                            document.getElementById("total-hpe").innerHTML = "Rp. " + total_2;
                            document.getElementById("total-hpe").style.color = '#F94687';
                        }
                        $(".sw-btn-next").prop('disabled', false);
                    }
                }
            }

            function blur_tembusan(ini) {
                var tembusan_2 = [""];
                for (var i = 0; i < clicktembusan; i++) {
                    if (i == 0) {
                        var value_tembusan = document.getElementById('tembusan[' + (i + 1) + ']').value
                        tembusan_2 += "<tr class='noborder'><td>Tembusan</td><td>:</td><td id='tembusan" + (i + 1) + "'>" + (i +
                            1) + ". " + value_tembusan + "</td></tr>"
                    } else {
                        var value_tembusan = document.getElementById('tembusan[' + (i + 1) + ']').value
                        tembusan_2 += "<tr class='noborder'><td></td><td></td><td id='tembusan" + (i + 1) + "'>" + (i + 1) +
                            ". " + value_tembusan + "</td></tr>"
                    }
                }
                document.getElementById('body_tembusan').innerHTML = tembusan_2;
            }

            function updatetembusan() {
                var tabel_tembusan = document.getElementById('tabel_tembusan');
                clicktembusan++;
                var input1 = document.createElement("input");
                input1.setAttribute("type", "text");
                input1.setAttribute("class", "form-control");
                input1.setAttribute("id", "tembusan[" + clicktembusan + "]");
                input1.setAttribute("name", "tembusan");
                input1.setAttribute("placeholder", "Tembusan");
                input1.setAttribute("required", true);
                input1.setAttribute("onblur", 'blur_tembusan(this)');
                var button = document.createElement("button");
                button.innerHTML = "<i class='fa fa-trash'></i>";
                button.setAttribute("onclick", "deleteRow3(this)");
                button.setAttribute("class", "btn btn-danger shadow btn-xs sharp");
                var row = tabel_tembusan.insertRow(-1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                cell1.innerHTML = "1";
                cell2.appendChild(input1);
                cell3.appendChild(button);
                reindex3();

                var tembusan_2 = [""];
                for (var i = 0; i < clicktembusan; i++) {
                    if (i == 0) {
                        var value_tembusan = document.getElementById('tembusan[' + (i + 1) + ']').value
                        tembusan_2 += "<tr class='noborder'><td>Tembusan</td><td>:</td><td id='tembusan" + (i + 1) + "'>" + (i +
                            1) + ". " + value_tembusan + "</td></tr>"
                    } else {
                        var value_tembusan = document.getElementById('tembusan[' + (i + 1) + ']').value
                        tembusan_2 += "<tr class='noborder'><td></td><td></td><td id='tembusan" + (i + 1) + "'>" + (i + 1) +
                            ". " + value_tembusan + "</td></tr>"
                    }
                }
                document.getElementById('body_tembusan').innerHTML = tembusan_2;
            }

            function reindex3() {
                const ids = document.querySelectorAll("#tabel_tembusan tr > td:nth-child(1)");
                ids.forEach((e, i) => {
                    e.innerHTML = "<strong id=nomor1[" + (i + 1) + "] value=" + (i + 1) + ">" + (i + 1) + "</strong>"
                    nomor_tabel_tembusan = i + 1;
                });
            }

            function deleteRow3(r) {
                var table = r.parentNode.parentNode.rowIndex;
                document.getElementById("tabel_tembusan").deleteRow(table);

                // document.getElementById("tabel_tembusan").deleteRow(table);
                clicktembusan--;
                var input_id_tembusan = document.querySelectorAll("#tabel_tembusan tr td:nth-child(2) input");
                for (var i = 0; i < input_id_tembusan.length; i++) {
                    input_id_tembusan[i].id = "tembusan[" + (i + 1) + "]";
                }
                reindex3();

                if (clicktembusan == 0) {
                    document.getElementById('body_tembusan').innerHTML = "";
                } else {
                    var tembusan_2 = [""];
                    for (var i = 0; i < clicktembusan; i++) {
                        if (i == 0) {
                            var value_tembusan = document.getElementById('tembusan[' + (i + 1) + ']').value
                            tembusan_2 += "<tr class='noborder'><td>Tembusan</td><td>:</td><td id='tembusan" + (i + 1) + "'>" +
                                (i +
                                    1) + ". " + value_tembusan + "</td></tr>"
                        } else {
                            var value_tembusan = document.getElementById('tembusan[' + (i + 1) + ']').value
                            tembusan_2 += "<tr class='noborder'><td></td><td></td><td id='tembusan" + (i + 1) + "'>" + (i + 1) +
                                ". " + value_tembusan + "</td></tr>"
                        }
                    }
                    document.getElementById('body_tembusan').innerHTML = tembusan_2;
                }

            }

            function onSubmitData() {
                var token = $('#csrf').val();
                var non_po_id = $('#non_po_id').val();
                var user_id = $('#user_id').val();
                var tujuan = $('#tujuan option:selected').val();
                var sumber = $('#sumber option:selected').val();
                var sifat = $('#sifat option:selected').val();
                var lampiran = $('#lampiran1').text();
                var sifat_lampiran = $('#sifat_lampiran option:selected').val();
                var perihal = $('#perihal').val();
                var isi_surat = $('#deskripsi_id').val();


                var harga_hpe = [];
                var jumlah_harga_hpe = [];

                var banyak_data = document.querySelectorAll("#tbody-kategori tr");

                var fd = new FormData();

                for (var i = 0; i < banyak_data.length; i++) {
                    harga_hpe[i] = document.getElementById("harga_hpe[" + (i + 1) + "]").value;
                    harga_hpe[i] = harga_hpe[i].replace(/\./g, "");
                    harga_hpe[i] = parseInt(harga_hpe[i]);
                    fd.append("harga_perkiraan[]", harga_hpe[i]);
                    jumlah_harga_hpe[i] = document.getElementById("jumlah_harga_hpe[" + (i + 1) + "]").value;
                    jumlah_harga_hpe[i] = jumlah_harga_hpe[i].replace(/\./g, "");
                    jumlah_harga_hpe[i] = parseInt(jumlah_harga_hpe[i]);
                    fd.append("jumlah_harga_perkiraan[]", jumlah_harga_hpe[i]);
                }

                tembusan = [];
                for (var i = 0; i < clicktembusan; i++) {
                    tembusan[i] = document.getElementById("tembusan[" + (i + 1) + "]").value;
                    fd.append("tembusan[]", tembusan[i]);
                }


                // console.log(uraian);
                // console.log(satuan);
                // console.log(volume);
                // console.log(harga_satuan);
                // console.log(harga);

                const bef_ppn_total_harga = jumlah_harga_hpe.reduce((accumulator, currentvalue) => accumulator + currentvalue);
                var ppn_id = document.getElementById('ppn').value;
                ppn_id = parseFloat(ppn_id);
                var ppn = bef_ppn_total_harga * ppn_id / 100;
                ppn = Math.round(ppn);
                var total_harga_hpe = bef_ppn_total_harga + ppn;
                total_harga_hpe = Math.round(total_harga_hpe);

                // if (kak.length > 0) {
                fd.append("total_harga_hpe", total_harga_hpe);
                fd.append("non_po_id", non_po_id);
                fd.append("user_id", user_id);


                fd.append("tujuan", tujuan);
                fd.append("sumber", sumber);
                fd.append("sifat", sifat);
                fd.append("lampiran", lampiran);
                fd.append("perihal", perihal);
                fd.append("isi_surat", isi_surat);
                // }

                swal({
                        title: "Apakah anda yakin?",
                        text: "Silakan cek kembali apabila data masih keliru",
                        icon: "warning",
                        buttons: true,
                    })
                    .then((willCreate) => {
                        document.getElementById('main-wrapper').style.cursor = "wait"
                        document.getElementById('btnFinish').setAttribute('disabled', true);
                        if (willCreate) {
                            // var data = {
                            //     "_token": token,
                            //     "nomor_rpbj": nomor_rpbj,
                            //     "skk_id": skk_id,
                            //     "prk_id": prk_id,
                            //     "kak": kak[0],
                            //     "total_harga": total_harga,
                            //     "uraian": uraian,
                            //     "satuan": satuan,
                            //     "harga_satuan": harga_satuan,
                            //     "volume": volume,
                            //     "jumlah_harga": harga,
                            //     "click": click,
                            // }
                            console.log("fd", fd);
                            // console.log(data);

                            $.ajax({
                                url: "/simpan-non-po-hpe",
                                method: 'POST',
                                data: fd,
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                success: function(response) {
                                    swal({
                                        title: "Data Ditambah",
                                        text: "Data Berhasil Ditambah",
                                        icon: "success",
                                        timer: 2e3,
                                        buttons: false
                                    })
                                    window.location.href = "../preview-hpe/" + response;
                                    //         .then((result) => {
                                    //         });
                                }
                            });
                        } else {
                            swal({
                                title: "Data Belum Ditambah",
                                text: "Silakan Cek Kembali Data Anda",
                                icon: "error",
                                timer: 2e3,
                                buttons: false
                            });
                            document.getElementById('main-wrapper').style.cursor = "default"
                            document.getElementById('btnFinish').removeAttribute('disabled');
                        }
                    })
            }

            function prev4() {
                btn_next4 = document.getElementById('btnnext4');
                btn_next4.innerText = "Next";
                btn_next4.setAttribute("id", "btnnext3");
                btn_next4.setAttribute("onclick", "next3()");

                btn_prev4 = document.getElementById('btnprev4');
                btn_prev4.setAttribute("id", "btnprev3");
                btn_prev4.setAttribute("onclick", "prev3()");
            }

            function prev3() {
                btn_next3 = document.getElementById('btnnext3');
                btn_next3.setAttribute("id", "btnnext2");
                btn_next3.setAttribute("onclick", "next2()");

                btn_prev3 = document.getElementById('btnprev3');
                btn_prev3.setAttribute("id", "btnprev2");
                btn_prev3.setAttribute("onclick", "prev2()");
            }
        </script>

        <script type="text/javascript">
            function tandaPemisahTitik(b) {
                var _minus = false;
                if (b < 0) _minus = true;
                b = b.toString();
                b = b.replace(".", "");
                b = b.replace("-", "");
                c = "";
                panjang = b.length;
                j = 0;
                for (i = panjang; i > 0; i--) {
                    j = j + 1;
                    if (((j % 3) == 1) && (j != 1)) {
                        c = b.substr(i - 1, 1) + "." + c;
                    } else {
                        c = b.substr(i - 1, 1) + c;
                    }
                }
                if (_minus) c = "-" + c;
                return c;
            }

            function numbersonly(ini, e) {
                if (e.keyCode >= 49) {
                    if (e.keyCode <= 57) {
                        a = ini.value.toString().replace(".", "");
                        b = a.replace(/[^\d]/g, "");
                        b = (b == "0") ? String.fromCharCode(e.keyCode) : b + String.fromCharCode(e.keyCode);
                        ini.value = tandaPemisahTitik(b);
                        return false;
                    } else if (e.keyCode <= 105) {
                        if (e.keyCode >= 96) {
                            //e.keycode = e.keycode - 47;
                            a = ini.value.toString().replace(".", "");
                            b = a.replace(/[^\d]/g, "");
                            b = (b == "0") ? String.fromCharCode(e.keyCode - 48) : b + String.fromCharCode(e.keyCode - 48);
                            ini.value = tandaPemisahTitik(b);
                            //alert(e.keycode);
                            return false;
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else if (e.keyCode == 48) {
                    a = ini.value.replace(".", "") + String.fromCharCode(e.keyCode);
                    b = a.replace(/[^\d]/g, "");
                    if (parseFloat(b) != 0) {
                        ini.value = tandaPemisahTitik(b);
                        return false;
                    } else {
                        return false;
                    }
                } else if (e.keyCode == 95) {
                    a = ini.value.replace(".", "") + String.fromCharCode(e.keyCode - 48);
                    b = a.replace(/[^\d]/g, "");
                    if (parseFloat(b) != 0) {
                        ini.value = tandaPemisahTitik(b);
                        return false;
                    } else {
                        return false;
                    }
                } else if (e.keyCode == 8 || e.keycode == 46) {
                    a = ini.value.replace(".", "");
                    b = a.replace(/[^\d]/g, "");
                    b = b.substr(0, b.length - 1);
                    if (tandaPemisahTitik(b) != "") {
                        ini.value = tandaPemisahTitik(b);
                    } else {
                        ini.value = "";
                    }

                    return false;
                } else if (e.keyCode == 9) {
                    return true;
                } else if (e.keyCode == 17) {
                    return true;
                } else {
                    //alert (e.keyCode);
                    return false;
                }
            }
        </script>
    @endsection

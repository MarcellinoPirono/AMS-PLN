@extends('layouts.main')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/kontrak-induk-khs">{{ $active }}</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $active1 }}</a></li>
        </ol>
    </div>

    <div class="row form-material">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $title }}</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form name="valid_upload_po" id="valid_upload_po" action="#">
                            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="first-name" class="form-label">No. Purchase
                                        Order(PO) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="po" name="po"
                                        value="{{ old('po') }}" placeholder="No. PO" required autofocus
                                        onblur="validunique(this)">
                                    <div class="valid-feedback">Data Terisi</div>
                                    <div id="invalid_po" class="invalid-feedback">Silakan Isi No. PO</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="first-name" class="form-label">Pilih No. Kontrak
                                    Induk <span class="text-danger">*</span></label>
                                    <select class="form-control input-default" id="kontrak_induk" name="kontrak_induk" style="height: 60px !important ; word-wrap: normal !important; white-space: normal; overflow: hidden;   text-overflow: ellipsis;"required>
                                        <option selected disabled value="">Pilih No. Kontrak Induk
                                        </option>
                                        @foreach ($kontraks as $kontrak)
                                            @if($kontrak->khs->isActive == True)
                                            <option value="{{ $kontrak->id }}">
                                                {{ $kontrak->khs->jenis_khs }} -
                                                {{ $kontrak->nomor_kontrak_induk }} -
                                                {{ $kontrak->vendors->nama_vendor }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback">
                                        Data Terpilih
                                    </div>
                                    <div class="invalid-feedback">
                                        Silakan Pilih No. Kontrak Induk
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
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
                                <div class="form-group col-md-6">
                                    <label class="text-label">Pilih Direksi Pekerjaan <span class="text-danger">*</span></label>
                                    <select class="form-control input-default" id="pejabat"
                                        name="pejabat"
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
                                <div class="form-group col-md-6">
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
                                <div class="form-group col-md-6">
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
                                <div class="form-group col-md-6">
                                    <label class="text-label">No. Addendum</label>
                                    <input type="text" class="form-control" name="addendum"
                                        id="addendum" placeholder="No. Addendum Belum Ada" required
                                        disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-label">Nama Vendor</label>
                                    <input type="text" class="form-control" name="vendor"
                                        id="vendor" placeholder="Nama Vendor" required disabled>
                                </div>
                                <div class="form-group col-md-6">
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
                                <div class="form-group col-md-6">
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
                                <div class="form-group col-md-6">
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
                                <div class="form-group col-md-6">
                                    <label class="text-label">Input Pengawas Lapangan</label>
                                    <input type="text" class="form-control" name="pengawas_lapangan"
                                        id="pengawas_lapangan" placeholder="Pengawas Lapangan" autofocus
                                        value="{{ old('pengawas_lapangan') }}">
                                    <div class="valid-feedback">
                                        Data Boleh Kosong
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-label">Upload Lampiran (.pdf)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input id="pdf_po" type="file" name="pdf_po"
                                                class="form-control custom-file-input"
                                                onchange="fileValidation(this);" accept=".pdf" />
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
                            <div class="position-relative justify-content-end float-right">
                                <button type="submit" class="btn btn-primary position-relative justify-content-end">Tambah
                                    Data</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>

<script>
    function validunique(ini) {
    var data = ini.value;

    $.ajax({
        type: 'post',
        url: '/checkPO',
        data: {
            'po':data
        },
        async: false,
        success: function(response) {
            check = response.length;
            // console.log(response);
        }
    })

    if(check > 0) {
        ini.setCustomValidity('Nomor PO Sudah Ada');
        document.getElementById('invalid_po').innerHTML = "Nomor PO Sudah Ada";
    } else {
        ini.setCustomValidity('');
        document.getElementById('invalid_po').innerHTML = "Silakan Isi No. PO";
    }
}

function fileValidation(ini) {
    // console.log(ini.files[0].size);
    if (ini.files[0].size > 20971520) {
        swal({
                title: "Size PDF Terlalu Besar",
                text: "File PDF Harus Dibawah 20 Mb",
                icon: "error",
                timer: 2e3,
                buttons: false
            })
            .then((willDefault) => {
                onclear();
            });
    } else {
        var fileInput = document.getElementById('lampiran');
        var feedback = document.getElementById('lampiranfile');

        var labelfile = $('#labelfile');

        var filePath = fileInput.value;

        // Allowing file type
        var allowedExtensions = filePath.split('.').pop();

        if (allowedExtensions != 'pdf') {

            fileInput.value = '';

        }
    }
}
</script>
<script>
    $(document).ready(function() {
        $('#valid_upload_po').validate({
            rules: {
                po: {
                    required: true
                },
                kontrak_induk: {
                    required: true
                },
                pekerjaan: {
                    required: true
                },
                pejabat: {
                    required: true
                },
                start_date: {
                    required: true
                },
                end_date: {
                    required: true
                },
                skk_id: {
                    required: true
                },
                prk_id: {
                    required: true
                },
                pengawas_pekerjaan: {
                    required: true
                },
                pdf_po: {
                    required: true
                },
            },
            messages: {
                po: {
                    required: "Silahkan Isi Nomor Purchase Order"
                },
                kontrak_induk: {
                    required: "Silakan Isi Nomor Kontrak Induk",
                },
                pekerjaan: {
                    required: "Silakan Isi Pekerjaan"
                },
                pejabat: {
                    required: "Silakan Pilih Direksi Pekerjaan"
                },
                start_date: {
                    required: "Silakan Pilih Start Date"
                },
                end_date: {
                    required: "Silakan Pilih End Date"
                },
                skk_id: {
                    required: "Silakan Pilih Nomor SKK"
                },
                prk_id: {
                    required: "Silakan Pilih Nomor PRK"
                },
                pengawas_pekerjaan: {
                    required: "Silakan Isi Pengawas Pekerjaan"
                },
                pdf_po: {
                    required: "Silakan Upload File PO"
                },
            },
            submitHandler: function(form) {
                var token = $('#csrf').val();
                var khs_id = $("#khs_id").val();
                var nomor_kontrak_induk = $("#nomor_kontrak_induk").val();
                var tanggal_kontrak_induk = $("#tanggal_kontrak_induk").val();
                var vendor_id = $("#vendor_id").val();
                var tanggal_kontrak_induk = new Date(tanggal_kontrak_induk);
                var tanggal_kontrak_induk = new Date(tanggal_kontrak_induk.getTime() - (tanggal_kontrak_induk.getTimezoneOffset() * 60000))
                    .toISOString().split("T")[0];

                var data = {
                    "_token": token,
                    "khs_id": khs_id,
                    "nomor_kontrak_induk": nomor_kontrak_induk,
                    "tanggal_kontrak_induk": tanggal_kontrak_induk,
                    "vendor_id": vendor_id,
                }

                $.ajax({
                    type: 'POST',
                    url: "{{ url('kontrak-induk-khs') }}",
                    data: data,
                    success: function(response) {
                        swal({
                                title: "Data Ditambah",
                                text: "Data Berhasil Ditambah",
                                icon: "success",
                                timer: 2e3,
                                buttons: false
                            })
                            .then((result) => {
                                window.location.href = "/kontrak-induk-khs";
                            });
                    }
                });
            }
        });
    });
</script>
@endsection





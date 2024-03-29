@extends('layouts.main')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/po-khs">{{ $active }}</a></li>
            <li class="breadcrumb-item active"><a href="">{{ $active1 }}</a></li>
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
                            <input type="hidden" value="{{ auth()->user()->id }}" id="user_id">
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
                                    <select class="form-control input-default" id="kontrak_induk" name="kontrak_induk"
                                        style="height: 60px !important ; word-wrap: normal !important; white-space: normal; overflow: hidden;   text-overflow: ellipsis;"required>
                                        <option selected disabled value="">Pilih No. Kontrak Induk
                                        </option>
                                        @foreach ($kontraks as $kontrak)
                                            @if ($kontrak->khs->isActive == true)
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
                                    <label class="text-label">Pilih Direksi Pekerjaan <span
                                            class="text-danger">*</span></label>
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
                                <div class="form-group col-md-6">
                                    <label class="text-label">Start Date <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-calendar2-minus"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="start_date" id="start_date"
                                            class="form-control datepicker-default2"required placeholder="Start Date PO-KHS"
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
                                    <label class="text-label">End Date <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-calendar2-minus"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="end_date" id="end_date"
                                            class="form-control datepicker-default2" placeholder="End Date PO-KHS"
                                            readonly="false" required autofocus style="border-radius: 0 20px 20px 0">
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
                                    <input type="text" class="form-control" name="addendum" id="addendum"
                                        placeholder="No. Addendum Belum Ada" required disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-label">Nama Vendor</label>
                                    <input type="text" class="form-control" name="vendor" id="vendor"
                                        placeholder="Nama Vendor" required disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-label">Input No.SKK <span class="text-danger">*</span></label>
                                    <select class="form-control input-default" id="skk_id" name="skk_id" required>
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
                                    <select class="form-control input-default" id="prk_id" name="prk_id" required>
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
                                    <label class="text-label">Input Pengawas Pekerjaan <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('pengawas') is-invalid @enderror"
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
                                    <label class="text-label">Input Total Harga (Rp.)</label>
                                    <input type="text" class="form-control" name="total_harga" id="total_harga"
                                        placeholder="Total Harga" autofocus value="{{ old('total_harga') }}"
                                        onkeydown="return numbersonly(this, event);">
                                    <div class="valid-feedback">
                                        Data Boleh Kosong
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-label">Upload File PO (.pdf)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input id="pdf_po" type="file" name="pdf_po"
                                                class="form-control custom-file-input" onchange="fileValidation(this);"
                                                accept=".pdf" />
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
                                <button type="submit"
                                    class="btn btn-primary position-relative justify-content-end">Tambah
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
        // function validunique(ini) {
        //     var data = ini.value;

        //     $.ajax({
        //         type: 'post',
        //         url: '/checkPO',
        //         data: {
        //             'po': data
        //         },
        //         async: false,
        //         success: function(response) {
        //             check = response.length;
        //             // console.log(response);
        //         }
        //     })

        //     if (check > 0) {
        //         ini.setCustomValidity('Nomor PO Sudah Ada');
        //         document.getElementById('invalid_po').innerHTML = "Nomor PO Sudah Ada";
        //     } else {
        //         ini.setCustomValidity('');
        //         document.getElementById('invalid_po').innerHTML = "Silakan Isi No. PO";
        //     }
        // }

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
                var fileInput = document.getElementById('pdf_po');
                // var feedback = document.getElementById('lampiranfile');

                var labelfile = $('#labelfile');

                var filePath = fileInput.value;

                // Allowing file type
                var allowedExtensions = filePath.split('.').pop();

                if (allowedExtensions != 'pdf') {

                    fileInput.value = '';

                }
            }
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
                    total_harga: {
                        required: true
                    },
                    pdf_po: {
                        required: true
                    }
                },
                messages: {
                    po: {
                        required: "Silahkan Isi Nomor Purchase Order"
                    },
                    kontrak_induk: {
                        required: "Silakan Isi Nomor Kontrak Induk"
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
                    total_harga: {
                        required: "Silakan Isi Total Harga"
                    },
                    pdf_po: {
                        required: "Silakan Upload File PO"
                    }
                },
                submitHandler: function(form) {
                    event.preventDefault();
                    var token = $('#csrf').val();
                    var po = $("#po").val();
                    var kontrak_induk = $("#kontrak_induk").val();
                    var pekerjaan = $("#pekerjaan").val();
                    var pejabat = $("#pejabat").val();
                    var start_date = $("#start_date").val();
                    var end_date = $("#end_date").val();
                    var addendum = $("#addendum").val();
                    var skk_id = $("#skk_id").val();
                    var prk_id = $("#prk_id").val();
                    var pengawas_pekerjaan = $("#pengawas_pekerjaan").val();
                    var pengawas_lapangan = $("#pengawas_lapangan").val();
                    var total_harga = $("#total_harga").val();
                    total_harga = total_harga.replace(/\./g, "");
                    total_harga = parseInt(total_harga);
                    var pdf_po = $('#pdf_po')[0].files;
                    var user_id = $('#user_id').val();
                    var today = new Date();
                    today = new Date(today.getTime() - (today.getTimezoneOffset() * 60000)).toISOString().split("T")[0];
                    start_date = new Date(start_date);
                    end_date = new Date(end_date);
                    start_date = new Date(start_date.getTime() - (start_date.getTimezoneOffset() *
                        60000)).toISOString().split("T")[0];
                    end_date = new Date(end_date.getTime() - (end_date.getTimezoneOffset() * 60000))
                        .toISOString().split("T")[0];

                    console.log(user_id);

                    var fd = new FormData();

                    fd.append("_token", token);
                    fd.append("nomor_po", po);
                    fd.append("nomor_kontrak_induk", kontrak_induk);
                    fd.append("pekerjaan", pekerjaan);
                    fd.append("pejabat_id", pejabat);
                    fd.append("startdate", start_date);
                    fd.append("enddate", end_date);
                    fd.append("addendum_id", addendum);
                    fd.append("skk_id", skk_id);
                    fd.append("prk_id", prk_id);
                    fd.append("pengawas_pekerjaan", pengawas_pekerjaan);
                    fd.append("pengawas_lapangan", pengawas_lapangan);
                    fd.append("total_harga", total_harga);
                    fd.append("user_id", user_id);
                    fd.append("tanggal_po", today);
                    fd.append("pdf_po", pdf_po[0]);

                    $.ajax({
                        type: 'POST',
                        url: "/simpan-upload-po",
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
                                .then((result) => {
                                    window.location.href = "/po-khs";
                                });
                        }
                    });
                }
            });
        });
    </script>

    <script>
        jQuery('#kontrak_induk').change(function() {
            let kontrak_induk = jQuery(this).val();
            let token = $("#csrf").val();
            jQuery('#addendum').val('');
            jQuery.ajax({
                url: '/getAddendum',
                type: 'POST',
                data: {

                    'kontrak_induk': kontrak_induk,
                    '_token': token,
                },
                success: function(result) {
                    if (result.length > 0) {
                        jQuery('#addendum').val(result[0].nomor_addendum)
                    }

                }
            });
        })

        jQuery('#kontrak_induk').change(function() {
            let kontrak_induk = jQuery(this).val();
            let token = $('#csrf').val();
            jQuery('#vendor').val('');
            jQuery.ajax({
                url: '/getVendor',
                type: 'POST',
                data: {
                    'kontrak_induk': kontrak_induk,
                    '_token': token,
                },
                success: function(result) {
                    if (result.length > 0) {
                        jQuery('#vendor').val(result)
                    }

                }
            });
        })

        jQuery('#skk_id').change(function() {
            let skk_id = jQuery(this).val();
            let token = $('#csrf').val();;
            jQuery.ajax({
                url: '/getSKK',
                type: 'POST',
                data: {

                    'skk_id': skk_id,
                    '_token': token,
                },
                success: function(result) {
                    jQuery('#prk_id').html(result)
                }
            });
        })
    </script>
@endsection

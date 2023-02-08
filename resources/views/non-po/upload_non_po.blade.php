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
                        <form name="valid_upload_non_po" id="valid_upload_non_po" action="#">
                            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                            <input type="hidden" value="{{ auth()->user()->id }}" id="user_id">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="text-label">Input Nota Dinas <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input id="nota_dinas" type="file"
                                                class="form-control custom-file-input"
                                                style="border-radius: 0 20px 20px 0" required
                                                onchange="fileValidation1(this);" accept=".pdf" />
                                            <label id="label_nota_dinas" class="custom-file-label">Choose or
                                                Drag file</label>
                                        </div>
                                    </div>
                                    <div class="valid-feedback">
                                        Data Terisi
                                    </div>
                                    <div class="invalid-feedback">
                                        Silakan Upload Nota Dinas
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-label">Upload KAK <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input id="kak" type="file"
                                                class="form-control custom-file-input" required
                                                onchange="fileValidation2(this);" accept=".pdf" />
                                            <label id="label_kak" class="custom-file-label">Choose or Drag
                                                file</label>
                                        </div>
                                    </div>
                                    <div class="valid-feedback">
                                        Data Terisi
                                    </div>
                                    <div class="invalid-feedback">
                                        Silakan Upload KAK
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-label">Input No. Nota Dinas <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nomor_rpbj"
                                        id="nomor_rpbj" placeholder="Nomor Nota Dinas" required autofocus
                                        value="{{ old('nomor_rpbj') }}" onblur="validunique(this)">
                                    <div class="valid-feedback">
                                        Data Terisi
                                    </div>
                                    <div id="invalid_nota_dinas" class="invalid-feedback">
                                        Silakan Isi Nomor Nota Dinas
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-label">Input Pekerjaan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="pekerjaan"
                                        id="pekerjaan" placeholder="Pekerjaan" required autofocus
                                        value="{{ old('pekerjaan') }}">
                                    <div class="valid-feedback">
                                        Data Terisi
                                    </div>
                                    <div class="invalid-feedback">
                                        Silakan isi Pekerjaan
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
                                    <label class="text-label">Supervisor <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="supervisor"
                                        id="supervisor" placeholder="Supervisor" required autofocus
                                        value="{{ old('supervisor') }}">
                                    <div class="valid-feedback">
                                        Data Terisi
                                    </div>
                                    <div class="invalid-feedback">
                                        Silakan isi Supervisor
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-label">Pilih Manager<span class="text-danger">*</span></label>
                                    <select class="form-control input-default" id="pejabat_id"
                                    style="height: 60px !important ; word-wrap: normal !important; white-space: normal; overflow: hidden;   text-overflow: ellipsis;"
                                    name="pejabat_id" required>
                                        <option value="" selected disabled>Manager
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
                                        Silakan Pilih Manager
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
                                    <label class="text-label">Input Total HPE(Rp.)</label>
                                    <input type="text" class="form-control" name="total_hpe" id="total_hpe"
                                        placeholder="Total HPE" autofocus value="{{ old('total_hpe') }}"
                                        onkeydown="return numbersonly(this, event);">
                                    <div class="valid-feedback">
                                        Data Boleh Kosong
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-label">Upload File Non-PO (.pdf)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input id="pdf_non_po" type="file" name="pdf_non_po"
                                                class="form-control custom-file-input" onchange="fileValidation(this);"
                                                accept=".pdf" />
                                            <label id="labelfile" class="custom-file-label">Choose or Drag
                                                file</label>
                                        </div>
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
            $('#valid_upload_non_po').validate({
                rules: {
                    nota_dinas: {
                        required: true
                    },
                    kak: {
                        required: true
                    },
                    nomor_rpbj: {
                        required: true
                    },
                    pekerjaan: {
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
                    supervisor: {
                        required: true
                    },
                    pejabat_id: {
                        required: true
                    },
                    total_harga: {
                        required: true
                    },
                    total_hpe: {
                        required: true
                    },
                    pdf_non_po: {
                        required: true
                    }
                },
                messages: {
                    nota_dinas: {
                        required: "Silahkan Upload Nota Dinas"
                    },
                    kak: {
                        required: "Silakan Upload KAK"
                    },
                    pekerjaan: {
                        required: "Silakan Isi Pekerjaan"
                    },
                    nomor_rpbj: {
                        required: "Silakan Isi Nomor Surat Dinas"
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
                    supervisor: {
                        required: "Silakan Isi Supervisor"
                    },
                    pejabat_id: {
                        required: "Silakan Pilih Manager"
                    },
                    total_harga: {
                        required: "Silakan Isi Total Harga"
                    },
                    total_hpe: {
                        required: "Silakan Isi Total HPE"
                    },
                    pdf_non_po: {
                        required: "Silakan Upload File PO"
                    }
                },
                submitHandler: function(form) {
                    event.preventDefault();
                    var token = $('#csrf').val();
                    var nota_dinas = $('#nota_dinas')[0].files;
                    var kak = $('#kak')[0].files;
                    var nomor_rpbj = $("#nomor_rpbj").val();
                    var pekerjaan = $("#pekerjaan").val();
                    var start_date = $("#start_date").val();
                    var end_date = $("#end_date").val();
                    var skk_id = $("#skk_id").val();
                    var prk_id = $("#prk_id").val();
                    var supervisor = $("#supervisor").val();
                    var pejabat_id = $("#pejabat_id").val();
                    var total_harga = $("#total_harga").val();
                    total_harga = total_harga.replace(/\./g, "");
                    total_harga = parseInt(total_harga);
                    var total_hpe = $("#total_hpe").val();
                    total_hpe = total_hpe.replace(/\./g, "");
                    total_hpe = parseInt(total_hpe);
                    var pdf_non_po = $('#pdf_non_po')[0].files;
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
                    fd.append("nota_dinas", nota_dinas[0]);
                    fd.append("kak", kak[0]);
                    fd.append("pekerjaan", pekerjaan);
                    fd.append("nomor_rpbj", nomor_rpbj);
                    fd.append("startdate", start_date);
                    fd.append("enddate", end_date);
                    fd.append("skk_id", skk_id);
                    fd.append("prk_id", prk_id);
                    fd.append("supervisor", supervisor);
                    fd.append("pejabat_id", pejabat_id);
                    fd.append("total_harga", total_harga);
                    fd.append("total_hpe", total_hpe);
                    fd.append("user_id", user_id);
                    fd.append("pdf_non_po", pdf_non_po[0]);

                    $.ajax({
                        type: 'POST',
                        url: "/simpan-upload-non-po",
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
                                    window.location.href = "/non-po";
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

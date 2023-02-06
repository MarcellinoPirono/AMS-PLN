@extends('layouts.main')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/addendum-khs">{{ $title }}</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $active1 }}</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $title }}</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form name="valid_addendum" id="valid_addendum" action="#">
                            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <select class="form-control input-default" id="kontrak_induk_id"
                                        name="kontrak_induk_id">
                                        <option value="0" selected disabled>No. Kontrak Induk</option>
                                        @foreach ($kontrakinduks as $kontrakinduk)
                                            @if($kontrakinduk->khs->isActive == True)
                                            <option value="{{ $kontrakinduk->id }}"
                                                data-jeniskhs="{{ $kontrakinduk->khs->jenis_khs }}"
                                                data-namapekerjaan="{{ $kontrakinduk->khs->nama_pekerjaan }}">
                                                {{ $kontrakinduk->nomor_kontrak_induk }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control input-default" name="jenis_khs" id="jenis_khs"
                                        placeholder="Jenis KHS" readonly disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control input-default" name="nama_pekerjaan"
                                        id="nama_pekerjaan" placeholder="Nama Pekerjaan" readonly disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control input-default" placeholder="Nomor Addendum"
                                        name="nomor_addendum" id="nomor_addendum" required autofocus>
                                </div>
                                <div class="form-group col-md-6 mt-4 mb-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-calendar2-minus"></i>
                                            </span>
                                        </div>
                                        <input name="tanggal_addendum" id="tanggal_addendum"
                                            class="datepicker-default form-control"
                                            placeholder="Tanggal Pembuatan Addendum " style="border-radius: 0 20px 20px 0"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-sm-10 mb-2">
                                    <div class="form-group">
                                        <label class="text-label">Input File Addendum</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                            <div class="custom-file">
                                                <input id="file_addendum" type="file"
                                                    class="form-control custom-file-input"
                                                    style="border-radius: 0 20px 20px 0" accept=".pdf"
                                                    onchange="fileValidation(this);" />
                                                <label id="labal_addendum" class="custom-file-label">Choose or Drag
                                                    file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-sm-1 mb-2 mt-45">
                                    <div class="form-group">
                                        <button class="btn btn-danger btn-xxs" onclick="onclear()">
                                            <i class='fa fa-trash' style=" margin-top:5px; margin-bottom: 5px"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative justify-content-end float-right">
                                <button type="submit" id="btntambah"
                                    class="btn btn-primary position-relative justify-content-end">Tambah Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>

<script>
    function fileValidation(ini) {
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
        }
    }

    function onclear() {
        var files = document.getElementById('file_addendum');
        files.value = "";

        var labelfile = document.getElementById('labal_addendum');
        labelfile.innerHTML = 'Choose or Drag file';

        event.preventDefault();
    }

    $(document).ready(function() {
        $('#kontrak_induk_id').on('change', function() {
            const selected = $(this).find('option:selected');
            const jenis_khs = selected.data('jeniskhs');
            const nama_pekerjaan = selected.data('namapekerjaan');
            $("#jenis_khs").val(jenis_khs);
            $("#nama_pekerjaan").val(nama_pekerjaan);
        });

        $('#valid_addendum').validate({
            rules: {
                kontrak_induk_id: {
                    required: true
                },
                nomor_addendum: {
                    required: true,
                    remote: {
                        url: "/checkAddendum",
                        type: "post"
                    }
                },
                tanggal_addendum: {
                    required: true
                }
            },
            messages: {
                kontrak_induk_id: {
                    required: "Silakan Pilih Nomor Kontrak Induk"
                },
                nomor_addendum: {
                    required: "Silakan Isi Nomor Addendum",
                    remote: "Nomor Addendum Sudah Ada"
                },
                tanggal_addendum: {
                    required: "Silakan Pilih Tanggal Addendum"
                }
            },
            submitHandler: function(form) {
                var token = $('#csrf').val();
                var kontrak_induk_id = $("#kontrak_induk_id").val();
                var nomor_addendum = $("#nomor_addendum").val();
                var tanggal_addendum = $("#tanggal_addendum").val();
                tanggal_addendum = new Date(tanggal_addendum);
                tanggal_addendum = new Date(tanggal_addendum.getTime() - (tanggal_addendum
                    .getTimezoneOffset() * 60000)).toISOString().split("T")[0];
                var pdf_file = $("#file_addendum")[0].files;
                // console.log(pdf_file);
                // console.log(pdf_file.length);

                var fd = new FormData();

                if (pdf_file.length > 0) {
                    fd.append("_token", token);
                    fd.append("kontrak_induk_id", kontrak_induk_id);
                    fd.append("nomor_addendum", nomor_addendum);
                    fd.append("tanggal_addendum", tanggal_addendum);
                    fd.append("pdf_file", pdf_file[0]);
                } else {
                    fd.append("_token", token);
                    fd.append("kontrak_induk_id", kontrak_induk_id);
                    fd.append("nomor_addendum", nomor_addendum);
                    fd.append("tanggal_addendum", tanggal_addendum);
                    fd.append("pdf_file", null);
                }

                // console.log(fd);

                $.ajax({
                    type: 'POST',
                    url: "{{ url('addendum-khs') }}",
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
                                window.location.href = "/addendum-khs";
                            });
                    }
                });
                // var data = {
                //     "_token": token,
                //     "kontrak_induk_id": kontrak_induk_id,
                //     "nomor_addendum": nomor_addendum,
                //     "tanggal_addendum": tanggal_addendum,
                //     "pdf_file": file_addendum[0],
                // };
                // console.log(data);

            }
        });



        // $('#btntambah').on('click', function() {
        //     var token = $('#csrf').val();
        //     var kontrak_induk_id = $("#kontrak_induk_id").val();
        //     var nomor_addendum = $("#nomor_addendum").val();
        //     var tanggal_addendum = $("#tanggal_addendum").val();
        //     // var date = Date.parse(tanggal_kontrak_induk);
        //     var date = new Date(tanggal_addendum);
        //     var dateString = new Date(date.getTime() - (date.getTimezoneOffset() * 60000 )).toISOString().split("T")[0];

        //     var data = {
        //         "_token": token,
        //         "kontrak_induk_id": kontrak_induk_id,
        //         "nomor_addendum": nomor_addendum,
        //         "tanggal_addendum": dateString,
        //     }

        //     $.ajax({
        //         type: 'POST',
        //         url: "{{ url('addendum-khs') }}",
        //         data: data,
        //         success: function(response) {
        //             swal({
        //                     title: "Data Ditambah",
        //                     text: "Data Berhasil Ditambah",
        //                     icon: "success",
        //                     timer: 2e3,
        //                     buttons: false
        //                 })
        //                 .then((result) => {
        //                     window.location.href = "/addendum-khs";
        //                 });
        //         }
        //     });
        // });
    });
</script>

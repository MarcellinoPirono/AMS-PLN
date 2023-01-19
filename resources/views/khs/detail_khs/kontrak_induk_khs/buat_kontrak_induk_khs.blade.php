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
                        <form name="valid_kontrak_induk" id="valid_kontrak_induk" action="#">
                            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <select class="form-control input-default" id="khs_id" name="khs_id">
                                        <option value="0" selected disabled>Jenis KHS</option>
                                        @foreach ($khss as $khs)
                                            <option value="{{ $khs->id }}"
                                                data-namapekerjaan="{{ $khs->nama_pekerjaan }}">{{ $khs->jenis_khs }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control input-default" name="nama_pekerjaan"
                                        id="nama_pekerjaan" placeholder="Nama Pekerjaan" readonly disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control input-default"
                                        placeholder="Nomor Kontrak Induk" name="nomor_kontrak_induk"
                                        id="nomor_kontrak_induk" required autofocus>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-calendar2-minus"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control datepicker-default"
                                            placeholder="Tanggal Kontrak Induk" id="tanggal_kontrak_induk" name="tanggal_kontrak_induk" style="border-radius: 0 20px 20px 0">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <select class="form-control input-default" id="vendor_id" name="vendor_id">
                                        <option value="0" selected disabled>Nama Vendor</option>
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->id }}">{{ $vendor->nama_vendor }}</option>
                                        @endforeach
                                    </select>
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
@endsection
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>


<script>
    $(document).ready(function() {
        $('#khs_id').on('change', function() {
            const selected = $(this).find('option:selected');
            const nama_pekerjaan = selected.data('namapekerjaan');
            $("#nama_pekerjaan").val(nama_pekerjaan);
        });

        $('#valid_kontrak_induk').validate({
            rules: {
                khs_id: {
                    required: true
                },
                nomor_kontrak_induk: {
                    required: true,
                    remote: {
                        url: "/checkKontrakInduk",
                        type: "post"
                    }
                },
                tanggal_kontrak_induk: {
                    required: true
                },
                vendor_id: {
                    required: true
                }
            },
            messages: {
                khs_id: {
                    required: "Silakan Pilih Jenis KHS"
                },
                nomor_kontrak_induk: {
                    required: "Silakan Isi Nomor Kontrak Induk",
                    remote: "Nomor Kontrak Induk Sudah Ada"
                },
                tanggal_kontrak_induk: {
                    required: "Silakan Isi Tanggal Kontrak Induk"
                },
                vendor_id: {
                    required: "Silakan Pilih Vendor"
                }
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

        // $('#btntambah').on('click', function() {
        //     var token = $('#csrf').val();
        //     var khs_id = $("#khs_id").val();
        //     var nomor_kontrak_induk = $("#nomor_kontrak_induk").val();
        //     var tanggal_kontrak_induk = $("#tanggal_kontrak_induk").val();
        //     // var date = Date.parse(tanggal_kontrak_induk);
        //     var vendor_id = $("#vendor_id").val();
        //     var date = new Date(tanggal_kontrak_induk);
        //     var dateString = new Date(date.getTime() - (date.getTimezoneOffset() * 60000 )).toISOString().split("T")[0];

        //     var data = {
        //         "_token": token,
        //         "khs_id": khs_id,
        //         "nomor_kontrak_induk": nomor_kontrak_induk,
        //         "tanggal_kontrak_induk": dateString,
        //         "vendor_id": vendor_id,
        //     }

        //     $.ajax({
        //         type: 'POST',
        //         url: "{{ url('kontrak-induk-khs') }}",
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
        //                     window.location.href = "/kontrak-induk-khs";
        //                 });
        //         }
        //     });
        // });
    });
</script>


@extends('layouts.main')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/vendor-khs">{{ $active }}</a></li>
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
                        <form name="valid_pejabat" id="valid_pejabat" action="#">
                            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control input-default" placeholder="Nama Pejabat"
                                        name="nama_pejabat" id="nama_pejabat" required autofocus
                                        value="{{ old('nama_pejabat') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control input-default" placeholder="Jabatan"
                                        name="jabatan" id="jabatan" required autofocus value="{{ old('jabatan') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <textarea type="text" class="form-control input-default" placeholder="Unit UP3" name="unit_up3" id="unit_up3"
                                        required autofocus>{{ old('unit_up3') }}</textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <textarea type="text" class="form-control input-default" placeholder="Unit ULP" name="unit_ulp" id="unit_ulp"
                                        required autofocus>{{ old('unit_ulp') }}</textarea>
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
    $(document).ready(function() {

        $('#valid_pejabat').validate({
            rules: {
                nama_pejabat: {
                    required: true
                },
                jabatan: {
                    required: true
                },
                unit_up3: {
                    required: true
                },
                unit_ulp: {
                    required: true
                }
            },
            messages: {
                nama_pejabat: {
                    required: "Silakan Isi Nama Pejabat"
                },
                jabatan: {
                    required: "Silakan Isi Jabatan"
                },
                unit_up3: {
                    required: "Silakan Isi Unit UP3"
                },
                unit_ulp: {
                    required: "Silakan Isi Unit ULP"
                }
            },
            submitHandler: function(form) {
                var token = $('#csrf').val();
                var nama_pejabat = $("#nama_pejabat").val();
                var jabatan = $("#jabatan").val();
                var unit_up3 = $("#unit_up3").val();
                var unit_ulp = $("#unit_ulp").val();

                var data = {
                    "_token": token,
                    "nama_pejabat": nama_pejabat,
                    "jabatan": jabatan,
                    "unit_up3": unit_up3,
                    "unit_ulp": unit_ulp,
                };

                $.ajax({
                    type: 'POST',
                    url: "{{ url('pejabat') }}",
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
                                window.location.href = "/pejabat";
                            });
                    }
                });
            }
        });

        // $('#btntambah').on('click', function() {
        //     var token = $('#csrf').val();
        //     var nama_vendor = $("#nama_vendor").val();
        //     var nama_direktur = $("#nama_direktur").val();
        //     var alamat_kantor_1 = $("#alamat_kantor_1").val();
        //     var alamat_kantor_2 = $("#alamat_kantor_2").val();
        //     var no_rek_1 = $("#no_rek_1").val();
        //     var nama_bank_1 = $("#nama_bank_1").val();
        //     var no_rek_2 = $("#no_rek_2").val();
        //     var nama_bank_2 = $("#nama_bank_2").val();
        //     var npwp = $("#npwp").val();
        //     $('.invalid-feedback' ).html("");


        //     var data = {
        //         "_token": token,
        //         "nama_vendor": nama_vendor,
        //         "nama_direktur": nama_direktur,
        //         "alamat_kantor_1": alamat_kantor_1,
        //         "alamat_kantor_2": alamat_kantor_2,
        //         "no_rek_1": no_rek_1,
        //         "nama_bank_1": nama_bank_1,
        //         "no_rek_2": no_rek_2,
        //         "nama_bank_2": nama_bank_2,
        //         "npwp": npwp,
        //     }

        //     $.ajax({
        //         type: 'POST',
        //         url: "{{ url('vendor-khs') }}",
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
        //                     window.location.href = "/vendor-khs";
        //                 });
        //         }

        //     });
        // });
    });
</script>

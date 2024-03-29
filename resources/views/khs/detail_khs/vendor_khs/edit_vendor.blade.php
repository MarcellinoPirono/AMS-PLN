@extends('layouts.main')

@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/vendor-khs">{{$active}}</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$active1}}</a></li>
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
                    <form name="edit_valid_vendor" id="edit_valid_vendor" action="#">
                        <input type="hidden" class="edit_id" id="edit_id" value="{{ $vendors->id }}">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default" placeholder="Nama Vendor" name="nama_vendor" id="nama_vendor" required autofocus value="{{ old('nama_vendor', $vendors->nama_vendor) }}">
                                <input type="hidden" id="old_vendor" value="{{ $vendors->nama_vendor }}">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default" placeholder="Nama Direktur" name="nama_direktur" id="nama_direktur" required autofocus value="{{ old('nama_direktur', $vendors->nama_direktur) }}">
                            </div>
                            <div class="form-group col-md-6">
                                <textarea type="text" class="form-control input-default" placeholder="Alamat Kantor 1" name="alamat_kantor_1" id="alamat_kantor_1" required autofocus>{{ old('alamat_kantor_1', $vendors->alamat_kantor_1)}}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <textarea type="text" class="form-control input-default" placeholder="Alamat Kantor 2" name="alamat_kantor_2" id="alamat_kantor_2" required autofocus>{{ old('alamat_kantor_2', $vendors->alamat_kantor_2)}}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="number" class="form-control input-default" placeholder="Nomor Rekening 1" name="no_rek_1" id="no_rek_1" required autofocus value="{{old('no_rek_1', $vendors->no_rek_1)}}">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default" placeholder="Nama Bank 1" name="nama_bank_1" id="nama_bank_1" required autofocus value="{{old('nama_bank_1', $vendors->nama_bank_1)}}">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="number" class="form-control input-default" placeholder="Nomor Rekening 2" name="no_rek_2" id="no_rek_2" required autofocus value="{{old('no_rek_2', $vendors->no_rek_2)}}">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default" placeholder="Nama Bank 2" name="nama_bank_2" id="nama_bank_2" required autofocus value="{{old('nama_bank_2', $vendors->nama_bank_2)}}">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default" placeholder="NPWP" name="npwp" id="npwp" required autofocus value="{{old('npwp', $vendors->npwp)}}">
                            </div>
                        </div>
                         <div class="position-relative justify-content-end float-right">
                            <button type="submit" id="btnedit"
                                class="btn btn-primary position-relative justify-content-end">Edit Data</button>
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
        var old_vendor = document.getElementById('old_vendor').value;
        $('#edit_valid_vendor').validate({
            rules:{
                nama_vendor:{
                    required: true,
                    remote: {
                        url: "/checkVendor_edit",
                        type: "post",
                        data: {
                            'old_vendor': old_vendor
                        }
                    }
                },
                nama_direktur:{
                    required:true
                },
                alamat_kantor_1:{
                    required:true
                },
                alamat_kantor_2:{
                    required:true
                },
                no_rek_1:{
                    required:true
                },
                nama_bank_1:{
                    required:true
                },
                no_rek_2:{
                    required:true
                },
                nama_bank_2:{
                    required:true
                },
                npwp:{
                    required:true
                }
            },
            messages:{
                nama_vendor:{
                    required: "Silakan Isi Nama Vendor",
                    remote: "Nama Vendor Sudah Ada"
                },
                nama_direktur:{
                    required: "Silakan Isi Nama Direktur"
                },
                alamat_kantor_1:{
                    required: "Silakan Isi Alamat Kantor 1"
                },
                alamat_kantor_2:{
                    required: "Silakan Isi Alamat Kantor 2"
                },
                no_rek_1:{
                    required: "Silakan Isi Nomor Rekening 1"
                },
                nama_bank_1:{
                    required: "Silakan Isi Nama Bank 1"
                },
                no_rek_2:{
                    required: "Silakan Isi Nomor Rekening 2"
                },
                nama_bank_2:{
                    required: "Silakan Isi Nama Bank 2"
                },
                npwp:{
                    required: "Silakan Isi NPWP"
                }
            },
            submitHandler: function(form) {
                    var id = $('#edit_id').val();
                    var nama_vendor = $("#nama_vendor").val();
                    var nama_direktur = $("#nama_direktur").val();
                    var alamat_kantor_1 = $("#alamat_kantor_1").val();
                    var alamat_kantor_2 = $("#alamat_kantor_2").val();
                    var no_rek_1 = $("#no_rek_1").val();
                    var nama_bank_1 = $("#nama_bank_1").val();
                    var no_rek_2 = $("#no_rek_2").val();
                    var nama_bank_2 = $("#nama_bank_2").val();
                    var npwp = $("#npwp").val();

                    var data = {
                        "nama_vendor": nama_vendor,
                        "nama_direktur": nama_direktur,
                        "alamat_kantor_1": alamat_kantor_1,
                        "alamat_kantor_2": alamat_kantor_2,
                        "no_rek_1": no_rek_1,
                        "nama_bank_1": nama_bank_1,
                        "no_rek_2": no_rek_2,
                        "nama_bank_2": nama_bank_2,
                        "npwp": npwp,
                    };

                    $.ajax({
                        type: 'PUT',
                        url: "{{ url('vendor-khs') }}" + '/' + id,
                        data: data,
                        success: function(response) {
                            swal({
                                    title: "Data Vendor Diedit",
                                    text: "Data Berhasil Diedit",
                                    icon: "success",
                                    timer: 2e3,
                                    buttons: false
                                })
                                .then((result) => {
                                    window.location.href = "/vendor-khs";
                                });
                        }
                    });
                }
        });

        // $('#btnedit').on('click', function() {
        //     var token = $('#csrf').val();
        //     var id = $('#edit_id').val();
        //     var nama_vendor = $("#nama_vendor").val();
        //     var nama_direktur = $("#nama_direktur").val();
        //     var alamat_kantor_1 = $("#alamat_kantor_1").val();
        //     var alamat_kantor_2 = $("#alamat_kantor_2").val();
        //     var no_rek_1 = $("#no_rek_1").val();
        //     var nama_bank_1 = $("#nama_bank_1").val();
        //     var no_rek_2 = $("#no_rek_2").val();
        //     var nama_bank_2 = $("#nama_bank_2").val();
        //     var npwp = $("#npwp").val();


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
        //         type: 'PUT',
        //         url: "{{ url('vendor-khs') }}" + '/' + id,
        //         data: data,
        //         success: function(response) {
        //             swal({
        //                     title: "Data Vendor Diedit",
        //                     text: "Data Berhasil Diedit",
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









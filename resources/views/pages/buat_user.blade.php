@extends('layouts.main')

@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/user">{{$active}}</a></li>
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
                    <form name="valid_vendor" id="valid_vendor" action="#">
                    <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="text-label">Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter a username..">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="text-label">Password *</label>
                                <div class="input-group transparent-append">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                    </div>
                                    <input type="password" class="form-control" id="dz-password" name="val-password" placeholder="Choose a safe one..">
                                    <div class="input-group-append show-pass ">
                                        <span class="input-group-text ">
                                            <i class="fa fa-eye-slash"></i>
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default" placeholder="Username" name="username" id="username" required autofocus value="{{ old('username') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default" placeholder="Password" name="password" id="password" required autofocus value="{{ old('password') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <textarea type="text" class="form-control input-default" placeholder="Alamat Kantor 1" name="alamat_kantor_1" id="alamat_kantor_1" required autofocus>{{ old('alamat_kantor_1') }}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <textarea type="text" class="form-control input-default" placeholder="Alamat Kantor 2" name="alamat_kantor_2" id="alamat_kantor_2" required autofocus>{{ old('alamat_kantor_2') }}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="number" class="form-control input-default" placeholder="Nomor Rekening 1" name="no_rek_1" id="no_rek_1" required autofocus value="{{ old('no_rek_1') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default" placeholder="Nama Bank 1" name="nama_bank_1" id="nama_bank_1" required autofocus value="{{ old('nama_bank_1') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="number" class="form-control input-default" placeholder="Nomor Rekening 2" name="no_rek_2" id="no_rek_2" required autofocus value="{{ old('no_rek_2') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default" placeholder="Nama Bank 2" name="nama_bank_2" id="nama_bank_2" required autofocus value="{{ old('nama_bank_2') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default" placeholder="NPWP" name="npwp" id="npwp" required autofocus>
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
    jQuery(document).ready(function(){

		jQuery('.show-pass').on('click',function(){
			jQuery(this).toggleClass('active');
			if(jQuery('#dz-password').attr('type') == 'password'){
				jQuery('#dz-password').attr('type','text');
			}else if(jQuery('#dz-password').attr('type') == 'text'){
				jQuery('#dz-password').attr('type','password');
			}
		});



	});
</script>

<script>
    $(document).ready(function() {

        $('#valid_vendor').validate({
            rules:{
                username:{
                    required: true
                },
                password:{
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
                username:{
                    required: "Silakan Isi Username"
                },
                password:{
                    required: "Silakan Isi Password"
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
                    var token = $('#csrf').val();
                    var username = $("#username").val();
                    var password = $("#password").val();
                    var alamat_kantor_1 = $("#alamat_kantor_1").val();
                    var alamat_kantor_2 = $("#alamat_kantor_2").val();
                    var no_rek_1 = $("#no_rek_1").val();
                    var nama_bank_1 = $("#nama_bank_1").val();
                    var no_rek_2 = $("#no_rek_2").val();
                    var nama_bank_2 = $("#nama_bank_2").val();
                    var npwp = $("#npwp").val();

                    var data = {
                        "_token": token,
                        "username": username,
                        "password": password,
                        "alamat_kantor_1": alamat_kantor_1,
                        "alamat_kantor_2": alamat_kantor_2,
                        "no_rek_1": no_rek_1,
                        "nama_bank_1": nama_bank_1,
                        "no_rek_2": no_rek_2,
                        "nama_bank_2": nama_bank_2,
                        "npwp": npwp,
                    };

                    $.ajax({
                        type: 'POST',
                        url: "{{ url('vendor-khs') }}",
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
                                    window.location.href = "/vendor-khs";
                                });
                        }
                    });
                }
        });

        // $('#btntambah').on('click', function() {
        //     var token = $('#csrf').val();
        //     var username = $("#username").val();
        //     var password = $("#password").val();
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
        //         "username": username,
        //         "password": password,
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

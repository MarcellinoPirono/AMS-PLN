@extends('layouts.main')

@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/kontrak-induk-khs">{{$active}}</a></li>
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
                   {{-- <form method="POST" action="/kontrak-induk-khs/{{ $kontrakinduks->id }}" class="" enctype="multipart/form-data">
                            @method('put')
                            @csrf --}}
                    <form name="edit_valid_kontrak_induk" id="edit_valid_kontrak_induk" action="#">
                        <!-- <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}"> -->
                        <input type="hidden" class="edit_id" id="edit_id" value="{{ $kontrakinduks->id }}">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <select class="form-control input-default" id="khs_id" name="khs_id">
                                    @foreach ($khss as $khs)
                                        <option value="{{ $khs->id }}" data-namapekerjaan="{{$khs->nama_pekerjaan}}" @if($kontrakinduks->khs_id == $khs->id)selected @endif>{{$khs->jenis_khs}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default" name="nama_pekerjaan" id="nama_pekerjaan" placeholder="Nama Pekerjaan" readonly disabled value="{{ old('khs_id', $kontrakinduks->khs->nama_pekerjaan) }}">             
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default " placeholder="Nomor Kontrak Induk" name="nomor_kontrak_induk" id="nomor_kontrak_induk" required autofocus value="{{ old('nomor_kontrak_induk', $kontrakinduks->nomor_kontrak_induk) }}">                                    
                            </div>                            
                            <div class="form-group col-md-6 icon1">
                                <input name="tanggal_kontrak_induk" id="tanggal_kontrak_induk" class="icon1 datepicker-default form-control"
                                        placeholder="Tanggal Kontrak Induk" value="{{ old('tanggal_kontrak_induk', $kontrakinduks->tanggal_kontrak_induk) }}" required >                        
                            </div>
                            <div class="form-group col-md-6">
                                <select class="form-control input-default" id="vendor_id" name="vendor_id">
                                    @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}" @if($kontrakinduks->vendor_id == $vendor->id)selected @endif>{{$vendor->nama_vendor}}
                                        </option>
                                    @endforeach
                                </select>
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
        $('#khs_id').on('change', function() {
            const selected = $(this).find('option:selected');
            // const jenis_khs = selected.data('jeniskhs'); 
            const nama_pekerjaan = selected.data('namapekerjaan'); 
            // $("#jenis_khs").val(jenis_khs);
            $("#nama_pekerjaan").val(nama_pekerjaan);
        });



        // $('#btnedit').on('click', function() {
        //     var token = $('#csrf').val();
        //     var id = $('#edit_id').val();
        //     var khs_id = $("#khs_id").val();
        //     var nomor_kontrak_induk = $("#nomor_kontrak_induk").val();
        //     var tanggal_kontrak_induk = $("#tanggal_kontrak_induk").val();
        //     var date = new Date(tanggal_kontrak_induk);
        //     var vendor_id = $("#vendor_id").val();
        //     var dateString = new Date(date.getTime() - (date.getTimezoneOffset() * 60000 )).toISOString().split("T")[0];
           

        //     var data = {
        //          "_token": token,
        //         "khs_id": khs_id,
        //         "nomor_kontrak_induk": nomor_kontrak_induk,
        //         "tanggal_kontrak_induk": dateString,
        //         "vendor_id": vendor_id,
        //     }
                        

        //     // $.ajax({
        //     //     url: "{{ url('kontrak-induk-khs') }}" + '/' + id,
        //     //     type: 'PUT',
        //     //     data: data,
        //     //     success: function(response) {
        //     //         swal({
        //     //                 title: "Data Diedit",
        //     //                 text: "Data Berhasil Diedit",
        //     //                 icon: "success",
        //     //                 timer: 2e3,
        //     //                 buttons: false
        //     //             })
        //     //             .then((result) => {
        //     //                 window.location.href = "/kontrak-induk-khs";
        //     //             });
        //     //     }
        //     // });
        // });
    });

    $(document).ready(function(){
        $('#edit_valid_kontrak_induk').validate({
                rules:{
                    khs_id:{
                        required: true
                    },
                    nomor_kontrak_induk:{
                        required:true
                    },
                    tanggal_kontrak_induk:{
                        required:true
                    },
                    vendor_id:{
                        required:true
                    }   
                },
                messages:{
                    khs_id:{
                        required: "Silakan Pilih Jenis KHS"
                    },
                    nomor_kontrak_induk:{
                        required: "Silakan Isi Nomor Kontrak Induk"
                    },
                    tanggal_kontrak_induk:{
                        required: "Silakan Isi Tanggal Kontrak Induk"
                    },
                    vendor_id:{
                        required: "Silakan Pilih Vendor"
                    }
                },
                // console.log();
                submitHandler: function(form) {
                    var id = $('#edit_id').val();
                    var khs_id = $("#khs_id").val();
                    var nomor_kontrak_induk = $("#nomor_kontrak_induk").val();
                    var tanggal_kontrak_induk = $("#tanggal_kontrak_induk").val();
                    var date = new Date(tanggal_kontrak_induk);
                    var vendor_id = $("#vendor_id").val();
                    var dateString = new Date(date.getTime() - (date.getTimezoneOffset() * 60000 )).toISOString().split("T")[0];
                    
                    var data = {                        
                        "khs_id": khs_id,
                        "nomor_kontrak_induk": nomor_kontrak_induk,
                        "tanggal_kontrak_induk": dateString,
                        "vendor_id": vendor_id,
                    }
                    $.ajax({
                        url: "{{ url('kontrak-induk-khs') }}" + '/' + id,
                        type: 'PUT',
                        data: data,
                        success: function(response) {
                            swal({
                                    title: "Data Diedit",
                                    text: "Data Berhasil Diedit",
                                    icon: "success",
                                    timer: 2e3,
                                    buttons: false
                                })
                                .then((result) => {
                                    window.location.href = "/kontrak-induk-khs";
                                });
                        }
                    })
                }
            });
    })
</script>






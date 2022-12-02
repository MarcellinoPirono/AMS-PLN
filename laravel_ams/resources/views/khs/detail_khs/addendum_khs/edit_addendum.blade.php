@extends('layouts.main')

@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/addendum-khs">{{$active}}</a></li>
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
                    <form name="edit_valid_addendum" id="edit_valid_addendum" action="#">
                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                            <input type="hidden" class="edit_id" id="edit_id" value="{{ $addendums->id }}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <select class="form-control input-default" id="kontrak_induk_id" name="kontrak_induk_id">
                                        @foreach ($kontrakinduks as $kontrakinduk)
                                        <option value="{{ $kontrakinduk->id }}" data-jeniskhs="{{$kontrakinduk->khs->jenis_khs}}" data-namapekerjaan="{{$kontrakinduk->khs->nama_pekerjaan}}" @if($addendums->kontrak_induk_id == $kontrakinduk->id) selected @endif>{{$kontrakinduk->nomor_kontrak_induk}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control input-default" name="jenis_khs" id="jenis_khs" placeholder="Jenis KHS" readonly disabled value="{{ old('kontrak_induk_id', $addendums->kontrak_induks->khs->jenis_khs) }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control input-default"  name="nama_pekerjaan" id="nama_pekerjaan" placeholder="Nama Pekerjaan" readonly disabled value="{{ old('kontrak_induk_id', $addendums->kontrak_induks->khs->nama_pekerjaan) }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control input-default" placeholder="Nomor Addendum" name="nomor_addendum" id="nomor_addendum"  value="{{ old('nomor_addendum', $addendums->nomor_addendum) }}" required autofocus>                                
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="bi bi-calendar2-minus"></i>
                                                </span>
                                            </div>
                                        <input type="text" name="tanggal_addendum" id="tanggal_addendum" class="form-control datepicker-default" placeholder="Tanggal Kontrak Induk" value="{{ old('tanggal_addendum', $addendums->tanggal_addendum) }}" style="border-radius: 0 20px 20px 0" required >
                                        </div>

                                    </div>
                                    
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
        $('#kontrak_induk_id').on('change', function() {
            const selected = $(this).find('option:selected');
            const jenis_khs = selected.data('jeniskhs');
            const nama_pekerjaan = selected.data('namapekerjaan');
            $("#jenis_khs").val(jenis_khs);
            $("#nama_pekerjaan").val(nama_pekerjaan);
        });

        $('#edit_valid_addendum').validate({
            rules:{
                kontrak_induk_id:{
                    required: true
                },
                nomor_addendum:{
                    required:true
                },
                tanggal_addendum:{
                    required:true
                }
            },
            messages:{
                kontrak_induk_id:{
                    required: "Silakan Pilih Nomor Kontrak Induk"
                },
                nomor_addendum:{
                    required: "Silakan Isi Nomor Addendum"
                },
                tanggal_addendum:{
                    required: "Silakan Pilih Tanggal Addendum"
                }
            },
                // console.log();
            submitHandler: function(form) {
                var id = $('#edit_id').val();
                var kontrak_induk_id = $("#kontrak_induk_id").val();
                var nomor_addendum = $("#nomor_addendum").val();
                var tanggal_addendum = $("#tanggal_addendum").val();
                var date = new Date(tanggal_addendum);                
                var tanggal_addendum = new Date(date.getTime() - (date.getTimezoneOffset() * 60000 )).toISOString().split("T")[0];
                
                var data = {                        
                    "kontrak_induk_id": kontrak_induk_id,
                    "nomor_addendum": nomor_addendum,
                    "tanggal_addendum": tanggal_addendum,                    
                }
                $.ajax({
                    url: "{{ url('addendum-khs') }}" + '/' + id,
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
                                window.location.href = "/addendum-khs";
                            });
                    }
                })
            }
        });

    // $('#btnedit').on('click', function() {
    //         var token = $('#csrf').val();
    //         var id = $('#edit_id').val();
    //         var kontrak_induk_id = $("#kontrak_induk_id").val();
    //         var nomor_addendum = $("#nomor_addendum").val();
    //         var tanggal_addendum = $("#tanggal_addendum").val();
    //         var date = new Date(tanggal_addendum);
    //         var dateString = new Date(date.getTime() - (date.getTimezoneOffset() * 60000 )).toISOString().split("T")[0];

    //         var data = {
    //              "_token": token,
    //             "kontrak_induk_id": kontrak_induk_id,
    //             "nomor_addendum": nomor_addendum,
    //             "tanggal_addendum": dateString,
    //         }

    //         $.ajax({
    //             url: "{{ url('addendum-khs') }}" + '/' + id,
    //             type: 'PUT',
    //             data: data,
    //             success: function(response) {
    //                 swal({
    //                         title: "Data Diedit",
    //                         text: "Data Berhasil Diedit",
    //                         icon: "success",
    //                         timer: 2e3,
    //                         buttons: false
    //                     })
    //                     .then((result) => {
    //                         window.location.href = "/addendum-khs";
    //                     });
    //             }
    //         });
    //     });
    });
</script>





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
                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">

                        <div class="form-row">
                            <div class="form-group col-md-6">                                                            
                                <select class="form-control input-default" id="kontrak_induk_id" name="kontrak_induk_id"> 
                                    <option value="0" selected disabled>No. Kontrak Induk</option>                                   
                                    @foreach ($kontrakinduks as $kontrakinduk)
                                    <option value="{{ $kontrakinduk->id }}" data-jeniskhs="{{$kontrakinduk->khs->jenis_khs}}" data-namapekerjaan="{{$kontrakinduk->khs->nama_pekerjaan}}" >{{ $kontrakinduk->nomor_kontrak_induk}}</option>
                                    @endforeach                                    
                                </select>
                            </div>                            
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default" name="jenis_khs" id="jenis_khs" placeholder="Jenis KHS" readonly disabled>             
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default"  name="nama_pekerjaan" id="nama_pekerjaan" placeholder="Nama Pekerjaan" readonly disabled>             
                            </div>    
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('nomor_addendum') is-invalid @enderror" placeholder="Nomor Addendum" name="nomor_addendum" id="nomor_addendum" required autofocus>
                                @error('nomor_addendum')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 icon1">
                               <input name="tanggal_addendum" id="tanggal_addendum" class="icon1 datepicker-default form-control @error('tanggal_addendum') is-invalid @enderror"
                                        placeholder="Tanggal Pembuatan Addendum " required >
                        
                                    @error('tanggal_addendum')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>                            
                        </div>
                        <div class="position-relative justify-content-end float-right">
                            <button type="submit" id="btntambah"
                                class="btn btn-primary position-relative justify-content-end">Tambah Data</button>
                        </div>
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

        $('#btntambah').on('click', function() {
            var token = $('#csrf').val();
            var kontrak_induk_id = $("#kontrak_induk_id").val();
            var nomor_addendum = $("#nomor_addendum").val();
            var tanggal_addendum = $("#tanggal_addendum").val();
            // var date = Date.parse(tanggal_kontrak_induk);
            var date = new Date(tanggal_addendum);
            var dateString = new Date(date.getTime() - (date.getTimezoneOffset() * 60000 )).toISOString().split("T")[0];

            var data = {
                "_token": token,
                "kontrak_induk_id": kontrak_induk_id,
                "nomor_addendum": nomor_addendum,
                "tanggal_addendum": dateString,
            }

            $.ajax({
                type: 'POST',
                url: "{{ url('addendum-khs') }}",
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
                            window.location.href = "/addendum-khs";
                        });
                }
            });
        });
    });
</script>

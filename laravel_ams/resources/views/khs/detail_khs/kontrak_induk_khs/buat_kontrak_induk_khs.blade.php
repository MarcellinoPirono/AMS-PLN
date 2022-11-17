@extends('layouts.main')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/kontrak-induk-khs">{{ $active }}</a></li>
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
                        <form method="POST" action="/kontrak-induk-khs" class="" enctype="multipart/form-data">
                            @csrf
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
                                    
                                    <input type="text"
                                        class="form-control input-default  @error('nomor_kontrak_induk') is-invalid @enderror"
                                        placeholder="Nomor Kontrak Induk" name="nomor_kontrak_induk"
                                        id="nomor_kontrak_induk" required autofocus>
                                    @error('nomor_kontrak_induk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>  
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <i class="bi bi-calendar2-minus"></i>
                                    <input name="datepicker" id="datepicker" class="datepicker-default form-control" @error('datepicker') is-invalid @enderror"
                                        placeholder="Tanggal Kontrak Induk" required >
                        
                                    @error('datepicker')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
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
                            <button type="submit" class="btn btn-primary position-relative">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<!-- <link id="bs-css" href="https://netdna.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css"
    rel="stylesheet"> -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#khs_id').on('change', function() {
            const selected = $(this).find('option:selected');
            const nama_pekerjaan = selected.data('namapekerjaan');
            $("#nama_pekerjaan").val(nama_pekerjaan);
        });
    });
</script>

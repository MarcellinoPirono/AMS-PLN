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
                    <form method="POST" action="/vendor-khs" class="" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('nama_vendor') is-invalid @enderror" placeholder="Nama Vendor" name="nama_vendor" id="nama_vendor" required autofocus value="{{ old('nama_vendor') }}">
                                    @error('nama_vendor')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>                            
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('nama_direktur') is-invalid @enderror" placeholder="Nomor Kontrak Induk" name="nama_direktur" id="nama_direktur" required autofocus value="{{ old('nama_direktur') }}">
                                    @error('nama_direktur')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>                            
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('alamat_kantor_1') is-invalid @enderror" placeholder="Alamat Kantor 1" name="alamat_kantor_1" id="alamat_kantor_1" required autofocus value="{{ old('alamat_kantor_1') }}">
                                @error('alamat_kantor_1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('alamat_kantor_2') is-invalid @enderror" placeholder="Alamat Kantor 2" name="alamat_kantor_2" id="alamat_kantor_2" required autofocus value="{{ old('alamat_kantor_2') }}">
                                @error('alamat_kantor_2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('no_rek_1') is-invalid @enderror" placeholder="Nomor Rekening 1" name="no_rek_1" id="no_rek_1" required autofocus value="{{ old('no_rek_1') }}">
                                @error('no_rek_1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('nama_bank_1') is-invalid @enderror" placeholder="Nama Bank 1" name="nama_bank_1" id="nama_bank_1" required autofocus value="{{ old('nama_bank_1') }}">
                                @error('nama_bank_1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('no_rek_2') is-invalid @enderror" placeholder="Nomor Rekening 12" name="no_rek_2" id="no_rek_2" required autofocus value="{{ old('no_rek_2') }}">
                                @error('no_rek_2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>                            
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('nama_bank_2') is-invalid @enderror" placeholder="Nama Bank 2" name="nama_bank_2" id="nama_bank_2" required autofocus value="{{ old('nama_bank_2') }}">
                                @error('nama_bank_2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('npwp') is-invalid @enderror" placeholder="NPWP" name="npwp" id="npwp" required autofocus>
                                @error('npwp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
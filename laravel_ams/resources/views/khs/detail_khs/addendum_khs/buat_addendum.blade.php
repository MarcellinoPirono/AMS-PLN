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
                                <select class="form-control input-default" id="no_kontrak_induk" name="no_kontrak_induk"> 
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#no_kontrak_induk').on('change', function() {
            const selected = $(this).find('option:selected');
            const jenis_khs = selected.data('jeniskhs'); 
            const nama_pekerjaan = selected.data('namapekerjaan'); 
            $("#jenis_khs").val(jenis_khs);
            $("#nama_pekerjaan").val(nama_pekerjaan);
        });
    });
</script>

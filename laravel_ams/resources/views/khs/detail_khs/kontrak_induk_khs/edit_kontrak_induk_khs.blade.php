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
                    <form method="POST" action="/kontrak-induk-khs/{{$kontrakinduks->id}}" class="" enctype="multipart/form-data">
                        @method('put')
                        @csrf
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
                                <input type="text" class="form-control input-default  @error('nomor_kontrak_induk') is-invalid @enderror" placeholder="Nomor Kontrak Induk" name="nomor_kontrak_induk" id="nomor_kontrak_induk" required autofocus value="{{ old('nomor_kontrak_induk', $kontrakinduks->nomor_kontrak_induk) }}">
                                    @error('nomor_kontrak_induk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>                            
                            <div class="form-group col-md-6">
                                <input type="date" class="form-control input-default  @error('tanggal_kontrak_induk') is-invalid @enderror" placeholder="Tanggal Kontrak Induk" name="tanggal_kontrak_induk" id="tanggal_kontrak_induk" required autofocus value="{{ old('tanggal_kontrak_induk', $kontrakinduks->tanggal_kontrak_induk)}}">
                                @error('tanggal_kontrak_induk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                        <button type="submit" class="btn btn-primary position-relative">Edit Kontrak Induk</button>
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
        $('#khs_id').on('change', function() {
            const selected = $(this).find('option:selected');
            // const jenis_khs = selected.data('jeniskhs'); 
            const nama_pekerjaan = selected.data('namapekerjaan'); 
            // $("#jenis_khs").val(jenis_khs);
            $("#nama_pekerjaan").val(nama_pekerjaan);
        });
    });
</script>






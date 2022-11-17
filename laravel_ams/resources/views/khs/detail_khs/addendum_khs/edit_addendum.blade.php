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
                    <form method="POST" action="/addendum-khs/{{$addendums->id}}" class="" enctype="multipart/form-data">
                        @method('put')
                        @csrf
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
                                <input type="text" class="form-control input-default  @error('nomor_addendum') is-invalid @enderror" placeholder="Nomor Addendum" name="nomor_addendum" id="nomor_addendum" required autofocus value="{{ old('nomor_addendum', $addendums->nomor_addendum) }}">
                                    @error('nomor_addendum')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>                            
                            <div class="form-group col-md-6">
                                <input type="date" class="form-control input-default  @error('tanggal_addendum') is-invalid @enderror" placeholder="Tanggal Addendum" name="tanggal_addendum" id="tanggal_addendum" required autofocus value="{{ old('tanggal_addendum', $addendums->tanggal_addendum)}}">
                                @error('tanggal_addendum')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>                            
                        </div>
                        <button type="submit" class="btn btn-primary position-relative">Edit Addendum</button>
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
        $('#kontrak_induk_id').on('change', function() {
            const selected = $(this).find('option:selected');
            const jenis_khs = selected.data('jeniskhs'); 
            const nama_pekerjaan = selected.data('namapekerjaan'); 
            $("#jenis_khs").val(jenis_khs);
            $("#nama_pekerjaan").val(nama_pekerjaan);
        });
    });
</script>





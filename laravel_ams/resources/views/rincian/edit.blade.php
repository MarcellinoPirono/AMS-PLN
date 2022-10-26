@extends('layouts.main')

@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/rincian">{{$active}}</a></li>
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
                    <form method="POST" action="/rincian/{{$rincian->kontraks_id}}" class="" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('nama_item') is-invalid @enderror" placeholder="Nama Item" name="nama_item" id="nama_item" required autofocus value="{{ old('nama_item', $items->nama_item) }}">
                                    @error('nama_item')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <select class="form-control custom-select input-default" id="kontraks_id" name="kontraks_id">
                                    @foreach ($kontraks as $item)
                                    @if (old('kontraks_id', $rincian->kontraks_id ) == $item->id)
                                        <!-- <option value="{{ $item->id }}" >{{ $item->nama_kontrak }}</option> -->
                                    @else
                                        <!-- <option value="{{ $item->id }}">{{ $item->nama_kontrak }}</option> -->
                                    @endif

                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('satuan') is-invalid @enderror" placeholder="Satuan" name="satuan" id="satuan" required autofocus value="{{ old('satuan'), $rincian->satuan}}">
                                @error('satuan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('harga_satuan') is-invalid @enderror" placeholder="Harga Satuan" name="harga_satuan" id="harga_satuan" required autofocus value="{{ old('harga_satuan', $rincian->harga_satuan) }}">
                                    @error('harga_satuan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary position-relative">Edit Rincian</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

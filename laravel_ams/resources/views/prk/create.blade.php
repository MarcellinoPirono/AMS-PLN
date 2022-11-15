@extends('layouts.main')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/prk">{{$active}}</a></li>
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
                                <form method="POST" action="/prk" class="" enctype="multipart/form-data">
                                    @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-25 col-form-label">No. SKK_PRK:</label>
                                            <div class="form-group col-md-6">
                                                <select class="form-control input-default" id="no_skk_prk" name="no_skk_prk">
                                                    @foreach ($skss as $skk)
                                                        <option value="{{ $skk->id }}" >{{ $skk->nomor_skk}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-25 col-form-label">No. PRK:</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control @error('no_prk') is-invalid @enderror" name="no_prk" id="no_prk" required autofocus value="{{ old('no_prk') }}">
                                                @error('no_prk')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-25 col-form-label">Uraian PRK:</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-default @error('uraian_prk') is-invalid @enderror" placeholder="Uraian PRK" name="uraian_prk" id="uraian_prk" required autofocus value="{{ old('uraian_prk') }}">
                                                @error('uraian_prk')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-25 col-form-label">Pagu PRK (Rp) :</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-default input-default @error('pagu_prk') is-invalid @enderror" placeholder="Pagu PRK" name="pagu_prk" id="pagu_prk" required autofocus value="{{ old('pagu_prk') }}">
                                                @error('pagu_prk')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-25 col-form-label">PRK Terkontrak (Rp) :</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-default @error('prk_terkontrak') is-invalid @enderror" placeholder="PRK Terkontrak" name="prk_terkontrak" id="prk_terkontrak" required autofocus value="{{ old('prk_terkontrak') }}">
                                                @error('prk_terkontrak')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-25 col-form-label">PRK Realisasi (Rp) :</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-default @error('prk_realisasi') is-invalid @enderror" placeholder="PRK Realisasi" name="prk_realisasi" id="prk_realisasi" required autofocus value="{{ old('prk_realisasi') }}">
                                                @error('prk_realisasi')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-25 col-form-label">PRK Terbayar (Rp) :</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-default @error('prk_terbayar') is-invalid @enderror" placeholder="PRK Terbayar" name="prk_terbayar" id="prk_terbayar" required autofocus value="{{ old('prk_terbayar') }}">
                                                @error('prk_terbayar')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-25 col-form-label">PRK Sisa (Rp) :</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-default @error('prk_sisa') is-invalid @enderror" placeholder="PRK Sisa" name="prk_sisa" id="prk_sisa" required autofocus value="{{ old('prk_sisa') }}">
                                                @error('prk_sisa')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    <div class="position-relative justify-content-end float-right">
                                        <button type="submit" class="btn btn-primary position-relative justify-content-end">Submit</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
					</div>
</div>
@endsection

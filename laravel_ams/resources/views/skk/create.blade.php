@extends('layouts.main')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/skk">{{$active}}</a></li>
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
                                    <form method="POST" action="/skk" class="" enctype="multipart/form-data">
                                    @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">No. SKK :</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-default  @error('nomor_skk') is-invalid @enderror" placeholder="Nomor SKK" name="nomor_skk" id="nomor_skk" required autofocus value="{{ old('nomor_skk') }}">
                                                 @error('nomor_skk')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Uraian SKK :</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-default  @error('uraian_skk') is-invalid @enderror" placeholder="Uraian SKK" name="uraian_skk" id="uraian_skk" required autofocus value="{{ old('uraian_skk') }}">
                                                    @error('uraian_skk')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Pagu SKK :</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-default  @error('pagu_skk') is-invalid @enderror" placeholder="Pagu SKK" name="pagu_skk" id="pagu_skk" required autofocus value="{{ old('pagu_skk') }}">
                                                    @error('pagu_skk')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">SKK Terkontrak :</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-default  @error('skk_terkontrak') is-invalid @enderror" placeholder="SKK Tekontrak" name="skk_terkontrak" id="skk_terkontrak" required autofocus value="{{ old('skk_terkontrak') }}">
                                                    @error('skk_terkontrak')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">SKK Realisasi :</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-default  @error('skk_realisasi') is-invalid @enderror" placeholder="SKK Realisasi" name="skk_realisasi" id="skk_realisasi" required autofocus value="{{ old('skk_realisasi') }}">
                                                    @error('skk_realisasi')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">SKK Terbayar :</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-default  @error('skk_terbayar') is-invalid @enderror" placeholder="SKK Terbayar" name="skk_terbayar" id="skk_terbayar" required autofocus value="{{ old('skk_terbayar') }}">
                                                    @error('skk_terbayar')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">SKK Sisa :</label>
                                            <div class="col-sm-6">
                                                 <input type="text" class="form-control input-default  @error('skk_sisa') is-invalid @enderror" placeholder="SKK Sisa" name="skk_sisa" id="skk_sisa" required autofocus value="{{ old('skk_sisa') }}">
                                                    @error('skk_sisa')
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

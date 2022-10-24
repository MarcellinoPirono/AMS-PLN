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
                                    <form>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control input-default" placeholder="Nama Item">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <select class="form-control custom-select input-default" id="inputCat">
                                                    <option value="" disabled selected hidden>Pilih Kategori</option>
                                                    <option value="1">Pemasangan SP 1 Phasa</option>
                                                    <option value="2">Pemasangan / Penarikan SP 3 Phasa</option>
                                                    <option value="3">Pembongkaran</option>
                                                    <option value="4">Pemeliharaan</option>
                                                    <option value="5">Pekerjaan Jasa Lainnya</option>
                                                    <option value="6">Material</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control input-default" placeholder="Satuan">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control input-default" placeholder="Harga Satuan">
                                            </div>
                                        </div>
                                    </form>
                                    <button type="button" class="btn btn-primary position-relative">Submit</button>
                                </div>
                            </div>
                        </div>
					</div>
</div>
@endsection
